<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day4;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day4Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $total = 0;
        foreach (explode(PHP_EOL, $input) as $row) {
            [$elf1, $elf2] = Elf::parse($row);
            if ($elf1->contains($elf2) || $elf2->contains($elf1)) {
                $total++;
            }
        }

        return (string)$total;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $total = 0;
        
        return (string)$total;
    }
}
