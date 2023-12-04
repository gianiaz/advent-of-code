<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day3;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day3Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $map = Map::parse($input);

        $numbers = $map->getNumbers();

        return (string) array_sum($numbers);
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $map = Map::parse($input);

        $ratios = $map->getGearRatios();

        return (string) array_sum($ratios);
    }
}
