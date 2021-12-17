<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day5;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day5Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var int[][] */
    private array $map = [];

    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return $this->calculateOverlaps($input, true);
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return $this->calculateOverlaps($input, false);
    }

    private function calculateOverlaps(string $input, bool $skipDiagonals): int
    {
        foreach (explode(PHP_EOL, $input) as $coordinates) {
            $line = new Line($coordinates);
            if ($skipDiagonals && $line->isDiagonal()) {
                continue;
            }

            foreach ($line->getLine() as [$x, $y]) {
                $this->map[$y][$x] ??= 0;
                $this->map[$y][$x] += 1;
            }
        }

        $count = 0;
        foreach ($this->map as $row) {
            foreach ($row as $value) {
                if ($value > 1) {
                    ++$count;
                }
            }
        }

        return $count;
    }
}
