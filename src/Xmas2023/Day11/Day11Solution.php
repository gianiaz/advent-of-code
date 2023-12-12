<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day11;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day11Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        return $this->getSumOfMinimumDistances($input, 1);
    }

    public function getSumOfMinimumDistances(?string $input, int $times): string
    {
        $input ??= Input::read(__DIR__);

        $map = SpaceMap::parse($input)->expand($times);

        return (string) array_sum(iterator_to_array($map->getMinimumDistances()));
    }

    public function solveSecondPart(string $input = null): string
    {
        return $this->getSumOfMinimumDistances($input, 999999);
    }
}
