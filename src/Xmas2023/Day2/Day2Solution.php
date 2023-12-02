<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day2;

use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day2Solution implements SolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $games = [];

        foreach (explode(PHP_EOL, $input) as $gameInput) {
            \Safe\preg_match('/Game (\d+): (.+)/', $gameInput, $matches);

            $games[$matches[1]] = Subset::parse($matches[2]);
        }

        $solution = 0;
        $basicSubset = new Subset();
        $basicSubset->red = 12;
        $basicSubset->green = 13;
        $basicSubset->blue = 14;

        foreach ($games as $count => $subset) {
            if ($subset->isPossible($basicSubset)) {
                $solution += $count;
            }
        }

        return (string) $solution;
    }
}
