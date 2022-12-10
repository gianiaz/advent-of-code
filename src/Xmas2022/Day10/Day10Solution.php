<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day10;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day10Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $device = new HandheldDevice();
        $device->loadInstructions($input);
        $result = 0;

        do {
            $device->startCycle();

            switch ($device->getTickCounter()) {
                case 20:
                case 60:
                case 100:
                case 140:
                case 180:
                case 220:
                    $result += $device->getSignalStrenght();
            }

            $device->completeCycle();
        } while ($device->getTickCounter() <= 220);

        return (string) $result;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $device = new HandheldDevice();
        $device->loadInstructions($input);
        $result = '';

        do {
            $device->startCycle();

            $result .= abs(($device->getTickCounter() % 40) - 1 - $device->getRegistryX()) <= 1
                ? '#'
                : ' '
            ;

            $device->completeCycle();

            if (0 === ($device->getTickCounter() % 40)) {
                $result .= PHP_EOL;
            }
        } while ($device->getTickCounter() < 240);

        return $result;
    }
}
