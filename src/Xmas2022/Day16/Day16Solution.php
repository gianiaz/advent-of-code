<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day16;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day16Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $vulcan = new Vulcan($input);

        return (string) $vulcan->getMaximumReleasedPressure();
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $vulcan = new Vulcan($input);

        return (string) $vulcan->getMaximumReleasedPressure();
    }
}
