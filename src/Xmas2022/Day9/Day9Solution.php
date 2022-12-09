<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day9Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        $rope = new Rope();

        foreach (explode(PHP_EOL, $input) as $row) {
            $rope->apply(new Instruction($row));
        }

        return (string) $rope->countVisitedByTail();
    }

    public function solveSecondPart(string $input = null): string
    {
        $map = $this->prepareMap($input);

        $result = 0;

        return (string) $result;
    }

    private function prepareMap(?string $input): array
    {
    }
}
