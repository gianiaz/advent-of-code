<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5;

use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Add;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Halt;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Multiply;
use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\PushInOutput;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\SaveFromInput;

class Day5Solution implements SolutionInterface
{
    public function solve()
    {
        // TODO: Implement solve() method.
    }

    public function run(Memory $memory): int
    {
        $computer = new IntcodeComputer([
            new Halt(),
            new Add(),
            new Multiply(),
            new PushInOutput(),
            new SaveFromInput(),
        ]);

        return $computer->run($memory);
    }
}
