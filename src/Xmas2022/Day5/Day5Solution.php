<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day5;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day5Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $crane = new Crane($input);
        $crane->run();

        $result = '';
        foreach ($crane->getStacks() as $stack) {
            $result .= array_pop($stack);
        }

        return $result;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $total = 0;

        return (string) $total;
    }
}
