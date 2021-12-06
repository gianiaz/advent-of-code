<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day6;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day6Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $fishes = [];
        foreach (explode(',', $input) as $startingValue) {
            $fishes[] = new Lanterfish((int) $startingValue);
        }

        $days = 80;

        do {
            $newFishes = [];
            foreach ($fishes as $fish) {
                $newFish = $fish->tick();

                if ($newFish) {
                    $newFishes[] = $newFish;
                }
            }
            $fishes = [...$fishes, ...$newFishes];
        } while (--$days);

        return count($fishes);
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }
}
