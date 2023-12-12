<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day6;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day6Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $races = $this->getRaces($input);
        $solution = 1;

        foreach ($races as $race) {
            $solution *= $race->getWinningCombinationsCount();
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

    /**
     * @return Race[]
     */
    private function getRaces(?string $input): array
    {
        $input ??= Input::read(__DIR__);
        [$times, $distances] = explode(PHP_EOL, $input);

        $times = \Safe\preg_replace('/\s+/', ' ', $times);
        $distances = \Safe\preg_replace('/\s+/', ' ', $distances);

        $times = explode(' ', $times);
        $distances = explode(' ', $distances);
        unset($times[0], $distances[0]);

        $races = [];
        foreach ($times as $i => $time) {
            $races[] = new Race((int) $time, (int) $distances[$i]);
        }

        return $races;
    }
}
