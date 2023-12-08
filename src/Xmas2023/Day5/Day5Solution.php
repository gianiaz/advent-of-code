<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day5;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day5Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $almanac = Almanac::parse($input);
        $solution = PHP_INT_MAX;

        foreach ($almanac->getSeeds() as $seed) {
            $solution = min($solution, $almanac->getLocation($seed));
        }

        return (string) $solution;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $almanac = Almanac::parse($input);
        $solution = PHP_INT_MAX;

        while ($almanac->getSeeds()->valid()) {
            $seed = $almanac->getSeeds()->current();
            $almanac->getSeeds()->next();
            $seedRange = $almanac->getSeeds()->current();
            $almanac->getSeeds()->next();

            do {
                $solution = min($solution, $almanac->getLocation($seed++));
            } while (--$seedRange);
        }

        return (string) $solution;
    }
}
