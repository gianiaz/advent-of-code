<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day11;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use const true;

class Day11Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        return $this->getSolution($input, 20, true);
    }

    public function solveSecondPart(string $input = null): string
    {
        return $this->getSolution($input, 10000, false);
    }

    private function getSolution(?string $input, int $rounds, bool $getsBored): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $jungle = new Jungle($input, $getsBored);
        while ($rounds--) {
            $jungle->doRound();
        }

        return (string) $jungle->getMonkeyBusiness();
    }
}
