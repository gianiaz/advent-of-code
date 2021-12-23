<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day18Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $numbers = explode(PHP_EOL, $input);
        $result = SnailFishNumber::createFromInput(array_shift($numbers));

        foreach ($numbers as $stringInput) {
            $result = $result->add($stringInput);
        }

        return $result->getMagnitude();
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $numbers = explode(PHP_EOL, $input);

        $maxMagnitude = 0;

        foreach ($numbers as $i => $first) {
            foreach ($numbers as $j => $second) {
                if ($i === $j) {
                    continue;
                }

                $maxMagnitude = max($maxMagnitude, (SnailFishNumber::createFromInput($first))->add($second)->getMagnitude());
            }
        }

        return $maxMagnitude;
    }
}
