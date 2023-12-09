<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day7;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day7Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $hands = [];
        foreach (explode(PHP_EOL, $input) as $row) {
            $hands[] = Hand::parse($row);
        }

        Hand::rank($hands);

        $total = 0;
        foreach ($hands as $rank => $hand) {
            $total += ($rank + 1) * $hand->bidding;
        }

        return (string) $total;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $map = Map::parse($input);

        return $map->countStepsAsGhost();
    }
}
