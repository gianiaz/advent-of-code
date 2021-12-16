<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day16Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }
}
