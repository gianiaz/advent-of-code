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

        $decryptionKey = 811589153;
        $encryptedCoordinates = new EncryptedCoordinates($input, $decryptionKey);

        for ($times = 0; $times < 10; ++$times) {
            echo 'Start swapping...';
            do {
            } while ($encryptedCoordinates->swapOneNode());

            $encryptedCoordinates->resetSwapCounts();

            echo ' swap ' . $times . ' completed' . PHP_EOL;
        }

        $result = $encryptedCoordinates->getNode(1000)->value
            + $encryptedCoordinates->getNode(2000)->value
            + $encryptedCoordinates->getNode(3000)->value
        ;

        return (string) ($result * $decryptionKey);
    }
}
