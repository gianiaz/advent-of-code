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
        $rocks = 2022;

        while ($rocks--) {
            $verticalChamber->simulateNextRock();
        }

        return (string) $verticalChamber->getMaxY();
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $vulcan = new Vulcan($input);

        return (string) $vulcan->getMaximumReleasedPressure();
    }
}
