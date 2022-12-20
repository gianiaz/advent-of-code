<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day20;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day20Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $encryptedCoordinates = new EncryptedCoordinates($input);
        do {
        } while ($encryptedCoordinates->swapOneNode());

        $result = $encryptedCoordinates->getNode(1000)->value
            + $encryptedCoordinates->getNode(2000)->value
            + $encryptedCoordinates->getNode(3000)->value
        ;

        return (string) $result;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $scan = new Scan($input);

        return (string) $scan->countExternalSides();
    }
}
