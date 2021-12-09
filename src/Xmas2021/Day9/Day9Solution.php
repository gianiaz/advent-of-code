<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day9;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day9Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var array<int, array<int, int>> */
    private array $map;
    /** @var array<int, array<int, int>> */
    private array $usedForBasin;

    public function solve(string $input = null)
    {
        $this->prepareMap($input);

        $totalRisk = 0;
        foreach ($this->findLowPointsCoordinates() as $coordinates) {
            $totalRisk += 1 + $this->getValue($coordinates['x'], $coordinates['y']);
        }

        return $totalRisk;
    }

    public function solveSecondPart(string $input = null)
    {
        $this->prepareMap($input);

        $basinSizes = [];
        foreach ($this->findLowPointsCoordinates() as $coordinates) {
        }

        sort($basinSizes);

        return array_pop($basinSizes)
            * array_pop($basinSizes)
            * array_pop($basinSizes)
        ;
    }

    private function prepareMap(string $input): void
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $value) {
                $this->map[$y][$x] = (int) $value;
            }
        }
    }

    private function getValue(int $x, int $y): int
    {
        return $this->map[$y][$x] ?? 10;
    }

    /**
     * @return \Generator<array{x: int, y: int}>
     */
    private function findLowPointsCoordinates(): \Generator
    {
        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $value) {
                if (
                    $value < $this->getValue($x - 1, $y)
                    && $value < $this->getValue($x + 1, $y)
                    && $value < $this->getValue($x, $y - 1)
                    && $value < $this->getValue($x, $y + 1)
                ) {
                    yield ['x' => $x, 'y' => $y];
                }
            }
        }
    }
}
