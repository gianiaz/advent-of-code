<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day4;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day4Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $solution = 0;

        foreach (explode(PHP_EOL, $input) as $row) {
            [$cardNumber, $scratchcardInput] = explode(': ', $row);
            $solution += Scratchcard::parse(trim($scratchcardInput))->getPoints();
        }

        return (string) $solution;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $result = 0;

        return (string) $result;
    }
}
