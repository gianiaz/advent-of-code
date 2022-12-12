<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day11;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day11Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $jungle = new Jungle($input);
        $rounds = 20;
        while ($rounds--) {
            $jungle->doRound();
        }

        return (string) $jungle->getMonkeyBusiness();
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $map = new Map($input);

        return (string) $map->findShorterDistanceFromLowestPoint();
    }
}
