<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day13;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day13Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $receiver = new Receiver($input);

        return (string) array_sum($receiver->getIndicesOfSortedCouples());
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $map = new Map($input);

        return (string) $map->findShorterDistanceFromLowestPoint();
    }
}
