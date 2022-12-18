<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use const true;

class Day17Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $verticalChamber = new VerticalChamber($input);

        return (string) $this->runSimulationFor(2022, $verticalChamber);
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $verticalChamber = new VerticalChamber($input);
        [$patternStart, $patternLength] = $verticalChamber->findPatternSize();

        $heightReachedAtStart = $this->runSimulationFor($patternStart, $verticalChamber);
        $heightReachedPerPattern = $this->runSimulationFor($patternLength, $verticalChamber, false) - $heightReachedAtStart;

        $rocks = 1000000000000;
        $heightReachedWithPattern = $heightReachedPerPattern * floor($rocks / $patternLength);

        $rocks -= $patternStart;
        $rocks %= $patternLength;

        $totalHeight = $heightReachedAtStart
            + $heightReachedWithPattern
            + $this->runSimulationFor($rocks, $verticalChamber, false);

        return (string) $totalHeight;
    }

    private function runSimulationFor(int $rocks, VerticalChamber $verticalChamber, bool $reset = true): int
    {
        if ($reset) {
            $verticalChamber->reset();
        }

        while ($rocks--) {
            $verticalChamber->simulateNextRock();
        }

        return $verticalChamber->getMaxY();
    }
}
