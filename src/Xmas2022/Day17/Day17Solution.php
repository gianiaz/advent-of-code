<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

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
        $rocks = 1000000000000;
        $totalHeight = $this->getHeightWithPatternCalculation($input, $rocks);

        return (string) $totalHeight;
    }

    private function getHeightWithPatternCalculation(?string $input, int $rocks): int
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $verticalChamber = new VerticalChamber($input);
        [$patternStart, $patternLength] = $verticalChamber->findPatternSize();

        $verticalChamber->reset();

        $heightReachedAtStart = $this->runSimulationFor($patternStart, $verticalChamber);
        $heightReachedPerPattern = $this->runSimulationFor($patternLength, $verticalChamber) - $heightReachedAtStart;

        $rocks -= $patternStart;
        $heightReachedWithPattern = $heightReachedPerPattern * ((int) floor($rocks / $patternLength) - 1);

        $rocks %= $patternLength;

        return $heightReachedWithPattern
            + $this->runSimulationFor($rocks, $verticalChamber);
    }

    private function runSimulationFor(int $rocks, VerticalChamber $verticalChamber): int
    {
        while ($rocks--) {
            $verticalChamber->simulateNextRock();
        }

        return $verticalChamber->getMaxY();
    }
}
