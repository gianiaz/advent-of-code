<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day9;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day9Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var array<int, array<int, int>> */
    private array $map;

    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $value) {
                $this->map[$x][$y] = (int) $value;
            }
        }

        $totalRisk = 0;
        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $value) {
                if (
                    $value < $this->getValue($x - 1, $y)
                    && $value < $this->getValue($x + 1, $y)
                    && $value < $this->getValue($x, $y - 1)
                    && $value < $this->getValue($x, $y + 1)
                ) {
                    $totalRisk += 1 + $value;
                }
            }
        }

        return $totalRisk;
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }

    private function getValue(int $x, int $y): int
    {
        return $this->map[$x][$y] ?? 10;
    }
}
