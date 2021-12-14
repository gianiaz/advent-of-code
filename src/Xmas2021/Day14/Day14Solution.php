<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day14;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day14Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        $machine = new PolymerMachine(...explode(PHP_EOL . PHP_EOL, $input));

        $steps = 10;
        do {
            $machine->step();
        } while (--$steps);

        $elementCounts = $machine->getElementCounts();

        return max($elementCounts) - min($elementCounts);
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        $machine = new PolymerMachine(...explode(PHP_EOL . PHP_EOL, $input));
    }
}
