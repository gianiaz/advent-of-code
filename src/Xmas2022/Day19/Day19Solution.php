<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day19;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day19Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $scan = new Scan($input);

        return (string) $scan->countFreeSides();
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $scan = new Scan($input);

        return (string) $scan->countExternalSides();
    }
}
