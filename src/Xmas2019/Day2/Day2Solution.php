<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Add;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Halt;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Multiply;

class Day2Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const INPUT = [1, 0, 0, 3, 1, 1, 2, 3, 1, 3, 4, 3, 1, 5, 0, 3, 2, 1, 10, 19, 1, 19, 6, 23, 2, 23, 13, 27, 1, 27, 5, 31, 2, 31, 10, 35, 1, 9, 35, 39, 1, 39, 9, 43, 2, 9, 43, 47, 1, 5, 47, 51, 2, 13, 51, 55, 1, 55, 9, 59, 2, 6, 59, 63, 1, 63, 5, 67, 1, 10, 67, 71, 1, 71, 10, 75, 2, 75, 13, 79, 2, 79, 13, 83, 1, 5, 83, 87, 1, 87, 6, 91, 2, 91, 13, 95, 1, 5, 95, 99, 1, 99, 2, 103, 1, 103, 6, 0, 99, 2, 14, 0, 0];

    public function solve(array $input = self::INPUT)
    {
        $memory = new Memory($input);
        $memory->set(1, 12);
        $memory->set(2, 2);

        return $this->run($memory);
    }

    public function solveSecondPart()
    {
        foreach (range(0, 99) as $noun) {
            foreach (range(0, 99) as $verb) {
                $memory = new Memory(self::INPUT);
                $memory->set(1, $noun);
                $memory->set(2, $verb);

                if (19690720 === $this->run($memory)) {
                    return 100 * $noun + $verb;
                }
            }
        }

        throw new \RuntimeException('Cannot find the solution');
    }

    public function run(Memory $memory): int
    {
        $computer = new IntcodeComputer([
            new Halt(),
            new Add(),
            new Multiply(),
        ]);

        return $computer->run($memory);
    }
}
