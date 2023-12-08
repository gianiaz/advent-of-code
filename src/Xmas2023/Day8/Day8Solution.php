<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day8;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day8Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $map = Map::parse($input);

        return (string) $map->countSteps();
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $map = Map::parse($input);

        return (string) $map->countStepsAsGhost();
    }
}
