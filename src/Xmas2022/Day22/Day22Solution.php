<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day22;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day22Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= rtrim(file_get_contents(__DIR__ . '/input.txt'));

        $board = new Board($input);
        $board->executeAllInstructions();

        return (string) $board->getPassword();
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= rtrim(file_get_contents(__DIR__ . '/input.txt'));

        $board = new CubicBoard($input);
        $board->executeAllInstructions();

        return (string) $board->getPassword();
    }
}
