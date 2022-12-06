<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day6;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day6Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        return $this->getMarker($input, 4);
    }

    public function solveSecondPart(string $input = null): string
    {
        return $this->getMarker($input, 14);
    }

    private function getMarker(?string $input, int $markerLength): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $marker = [];
        $inputLength = strlen($input);

        for ($i = 0; $i < $inputLength; ++$i) {
            $marker[] = $input[$i];
            if (count($marker) < $markerLength) {
                continue;
            }

            if (count(array_unique($marker)) === $markerLength) {
                return (string) (1 + $i);
            }

            array_shift($marker);
        }

        throw new \RuntimeException('Unable to find start-of-packet marker');
    }
}
