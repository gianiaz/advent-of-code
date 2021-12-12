<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day11;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day11Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $map = new OctopusMap($input);
        $steps = 100;
        $total = 0;
        while ($steps--) {
            $total += $map->step();
        }

        return $total;
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }
}
