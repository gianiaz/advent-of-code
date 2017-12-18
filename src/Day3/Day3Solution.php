<?php

namespace Jean85\AdventOfCode\Day3;

use Jean85\AdventOfCode\SolutionInterface;

class Day3Solution implements SolutionInterface
{
    private const INPUT = 289326;

    public function solve()
    {
        return (new Grid())->getGridCost(self::INPUT);
    }
}
