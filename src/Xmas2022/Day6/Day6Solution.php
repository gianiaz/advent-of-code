<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day6;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day6Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $marker = [];
        $inputLength = strlen($input);

        for ($i = 0; $i < $inputLength; ++$i) {
            $marker[] = $input[$i];
            if (count($marker) < 4) {
                continue;
            }

            if (count(array_unique($marker)) === 4) {
                return (string) (1 + $i);
            }

            array_shift($marker);
        }

        throw new \RuntimeException('Unable to find start-of-packet marker');
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return $result;
    }
}
