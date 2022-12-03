<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day3;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day3Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $total = 0;
        foreach (explode(PHP_EOL, $input) as $row) {
            $ruckSack = new RuckSack($row);

            $total += $ruckSack->getPriority();
        }

        return (string)$total;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return '';
    }
}
