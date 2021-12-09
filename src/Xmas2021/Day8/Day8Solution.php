<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day8;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day8Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var array<int,int> */
    private array $memoizedCosts = [];

    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $countByLength = [];
        foreach (range(1, 7) as $lenght) {
            $countByLength[$lenght] = 0;
        }

        foreach (explode(PHP_EOL, $input) as $row) {
            [$first, $second] = explode(' | ', $row);
            foreach (explode(' ', $second) as $value) {
                $countByLength[strlen($value)] += 1;
            }
        }

        return $countByLength[2] // 1
            + $countByLength[4] // 4
            + $countByLength[3] // 7
            + $countByLength[7] // 8
        ;
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }
}
