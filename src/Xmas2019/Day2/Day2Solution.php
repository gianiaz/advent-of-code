<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2;

use Jean85\AdventOfCode\SolutionInterface;

class Day2Solution implements SolutionInterface
{
    public const ADD = 1;
    public const MULTIPLY = 2;
    public const HALT = 99;

    private const INPUT = [1, 0, 0, 3, 1, 1, 2, 3, 1, 3, 4, 3, 1, 5, 0, 3, 2, 1, 10, 19, 1, 19, 6, 23, 2, 23, 13, 27, 1, 27, 5, 31, 2, 31, 10, 35, 1, 9, 35, 39, 1, 39, 9, 43, 2, 9, 43, 47, 1, 5, 47, 51, 2, 13, 51, 55, 1, 55, 9, 59, 2, 6, 59, 63, 1, 63, 5, 67, 1, 10, 67, 71, 1, 71, 10, 75, 2, 75, 13, 79, 2, 79, 13, 83, 1, 5, 83, 87, 1, 87, 6, 91, 2, 91, 13, 95, 1, 5, 95, 99, 1, 99, 2, 103, 1, 103, 6, 0, 99, 2, 14, 0, 0];

    public function solve(array &$memory = self::INPUT)
    {
        $memory[1] = 12;
        $memory[2] = 2;

        return $this->run($memory);
    }

    public function run(array &$memory)
    {
        $pointer = 0;

        while ($this->step($memory, $pointer)) {
            $pointer += 4;
        }

        return $memory[0];
    }

    public function step(array &$memory, int $position): bool
    {
        $opcode = $memory[$position];

        if ($opcode === self::HALT) {
            return false;
        }

        $input1 = $this->getFromPosition($memory, $position + 1);
        $input2 = $this->getFromPosition($memory, $position + 2);
        $resultPosition = $memory[$position + 3];

        switch ($opcode) {
            case self::ADD:
                $memory[$resultPosition] = $input1 + $input2;

                return true;
            case self::MULTIPLY:
                $memory[$resultPosition] = $input1 * $input2;

                return true;
            default:
                throw new \InvalidArgumentException(sprintf('Invalid opcode %d at position %d', $opcode, $position));
        }
    }

    private function getFromPosition(array $memory, int $position): int
    {
        $positionToExtractFrom = $memory[$position];

        return $memory[$positionToExtractFrom];
    }
}
