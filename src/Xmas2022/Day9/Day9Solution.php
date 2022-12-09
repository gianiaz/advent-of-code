<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day9Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $rope = new Rope();

        return $this->simulateRope($input, $rope);
    }

    public function solveSecondPart(string $input = null): string
    {
        $rope = new RopeWithMultipleKnots(10);

        return $this->simulateRope($input, $rope);
    }

    private function simulateRope(?string $input, Rope $rope): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        foreach (explode(PHP_EOL, $input) as $row) {
            $rope->apply(new Instruction($row));
        }

        return (string)$rope->countVisitedByTail();
    }
}
