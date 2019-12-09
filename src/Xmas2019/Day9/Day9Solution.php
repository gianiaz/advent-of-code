<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day9;

use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Add;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Halt;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Multiply;
use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\Equals;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\JumpIfFalse;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\JumpIfTrue;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\LessThan;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\PushInOutput;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\SaveFromInput;
use Jean85\AdventOfCode\Xmas2019\Day9\Instructions\AdjustRelativeBase;

class Day9Solution implements SolutionInterface
{
    public function solve()
    {
        // TODO: Implement solve() method.
    }

    public function creatComputer(): IntcodeComputer
    {
        return new IntcodeComputer([
            new Halt(),
            new Add(),
            new Multiply(),
            new PushInOutput(),
            new SaveFromInput(),
            new Equals(),
            new JumpIfFalse(),
            new JumpIfTrue(),
            new LessThan(),
            new AdjustRelativeBase(),
        ]);
    }
}
