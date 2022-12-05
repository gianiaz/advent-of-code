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

        return (string) $total;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $ruckSackGenerator = $this->generate($input);
        $total = 0;

        do {
            $elf1 = $ruckSackGenerator->current();
            $ruckSackGenerator->next();
            $elf2 = $ruckSackGenerator->current();
            $ruckSackGenerator->next();
            $elf3 = $ruckSackGenerator->current();
            $ruckSackGenerator->next();

            $total += $this->findCommon($elf1, $elf2, $elf3);
        } while ($ruckSackGenerator->valid());

        return (string) $total;
    }

    /**
     * @return \Generator<string>
     */
    private function generate(string $input): \Generator
    {
        foreach (explode(PHP_EOL, $input) as $row) {
            yield array_unique(str_split($row));
        }
    }

    /*
     * @param string[] $elf1
     * @param string[] $elf2
     * @param string[] $elf3
     */
    private function findCommon(array $elf1, array $elf2, array $elf3): int
    {
        $priority = 0;
        foreach (array_intersect($elf1, $elf2, $elf3) as $commonItem) {
            $priority += RuckSack::convertToPriority($commonItem);
        }

        return $priority;
    }
}
