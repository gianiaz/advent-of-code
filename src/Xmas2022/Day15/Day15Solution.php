<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day15;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day15Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $scan = new Scan($input);

        return (string) $scan->countOccupiedPositionsAtRow(2000000);
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $scan = new Scan($input);
        $missingBeacon = $scan->findMissingBeacon(4000000);

        return (string) (($missingBeacon->x * 4000000) + $missingBeacon->y);
    }
}
