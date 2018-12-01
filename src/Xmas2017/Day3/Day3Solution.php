<?php

namespace Jean85\AdventOfCode\Xmas2017\Day3;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day3Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const INPUT = 289326;

    public function solve()
    {
        return (new Grid())->getGridCost(self::INPUT);
    }

    public function solveSecondPart()
    {
        return (new GridWithMemory())->getGridStepAfter(self::INPUT);
    }
}
