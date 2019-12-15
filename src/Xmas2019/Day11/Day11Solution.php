<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day11;

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
use Jean85\AdventOfCode\Xmas2019\Day7\MemoryWithSequentialIO;
use Jean85\AdventOfCode\Xmas2019\Day9\Instructions\AdjustRelativeBase;

class Day11Solution implements SolutionInterface
{
    private const INPUT = [3, 8, 1005, 8, 311, 1106, 0, 11, 0, 0, 0, 104, 1, 104, 0, 3, 8, 1002, 8, -1, 10, 101, 1, 10, 10, 4, 10, 108, 0, 8, 10, 4, 10, 1002, 8, 1, 28, 2, 103, 7, 10, 3, 8, 1002, 8, -1, 10, 101, 1, 10, 10, 4, 10, 1008, 8, 1, 10, 4, 10, 1001, 8, 0, 55, 2, 3, 6, 10, 1, 101, 5, 10, 1, 6, 7, 10, 3, 8, 1002, 8, -1, 10, 101, 1, 10, 10, 4, 10, 1008, 8, 0, 10, 4, 10, 1001, 8, 0, 89, 1, 1108, 11, 10, 2, 1002, 13, 10, 1006, 0, 92, 1, 2, 13, 10, 3, 8, 102, -1, 8, 10, 1001, 10, 1, 10, 4, 10, 1008, 8, 0, 10, 4, 10, 101, 0, 8, 126, 3, 8, 1002, 8, -1, 10, 101, 1, 10, 10, 4, 10, 108, 1, 8, 10, 4, 10, 1002, 8, 1, 147, 1, 7, 0, 10, 3, 8, 1002, 8, -1, 10, 1001, 10, 1, 10, 4, 10, 108, 0, 8, 10, 4, 10, 101, 0, 8, 173, 1006, 0, 96, 3, 8, 102, -1, 8, 10, 101, 1, 10, 10, 4, 10, 108, 0, 8, 10, 4, 10, 1001, 8, 0, 198, 1, 3, 7, 10, 1006, 0, 94, 2, 1003, 20, 10, 3, 8, 102, -1, 8, 10, 1001, 10, 1, 10, 4, 10, 1008, 8, 1, 10, 4, 10, 102, 1, 8, 232, 3, 8, 102, -1, 8, 10, 101, 1, 10, 10, 4, 10, 108, 1, 8, 10, 4, 10, 102, 1, 8, 253, 1006, 0, 63, 1, 109, 16, 10, 3, 8, 1002, 8, -1, 10, 101, 1, 10, 10, 4, 10, 1008, 8, 1, 10, 4, 10, 101, 0, 8, 283, 2, 1107, 14, 10, 1, 105, 11, 10, 101, 1, 9, 9, 1007, 9, 1098, 10, 1005, 10, 15, 99, 109, 633, 104, 0, 104, 1, 21102, 837951005592, 1, 1, 21101, 328, 0, 0, 1105, 1, 432, 21101, 0, 847069840276, 1, 21101, 0, 339, 0, 1106, 0, 432, 3, 10, 104, 0, 104, 1, 3, 10, 104, 0, 104, 0, 3, 10, 104, 0, 104, 1, 3, 10, 104, 0, 104, 1, 3, 10, 104, 0, 104, 0, 3, 10, 104, 0, 104, 1, 21102, 179318123543, 1, 1, 21102, 386, 1, 0, 1106, 0, 432, 21102, 1, 29220688067, 1, 21102, 1, 397, 0, 1106, 0, 432, 3, 10, 104, 0, 104, 0, 3, 10, 104, 0, 104, 0, 21102, 709580567396, 1, 1, 21102, 1, 420, 0, 1105, 1, 432, 21102, 1, 868498694912, 1, 21102, 431, 1, 0, 1106, 0, 432, 99, 109, 2, 22101, 0, -1, 1, 21101, 40, 0, 2, 21101, 0, 463, 3, 21101, 0, 453, 0, 1105, 1, 496, 109, -2, 2106, 0, 0, 0, 1, 0, 0, 1, 109, 2, 3, 10, 204, -1, 1001, 458, 459, 474, 4, 0, 1001, 458, 1, 458, 108, 4, 458, 10, 1006, 10, 490, 1102, 1, 0, 458, 109, -2, 2105, 1, 0, 0, 109, 4, 1202, -1, 1, 495, 1207, -3, 0, 10, 1006, 10, 513, 21102, 0, 1, -3, 21201, -3, 0, 1, 21202, -2, 1, 2, 21101, 0, 1, 3, 21101, 0, 532, 0, 1106, 0, 537, 109, -4, 2106, 0, 0, 109, 5, 1207, -3, 1, 10, 1006, 10, 560, 2207, -4, -2, 10, 1006, 10, 560, 22102, 1, -4, -4, 1105, 1, 628, 21201, -4, 0, 1, 21201, -3, -1, 2, 21202, -2, 2, 3, 21101, 0, 579, 0, 1105, 1, 537, 22101, 0, 1, -4, 21102, 1, 1, -1, 2207, -4, -2, 10, 1006, 10, 598, 21102, 1, 0, -1, 22202, -2, -1, -2, 2107, 0, -3, 10, 1006, 10, 620, 22102, 1, -1, 1, 21101, 0, 620, 0, 106, 0, 495, 21202, -2, -1, -2, 22201, -4, -2, -4, 109, -5, 2106, 0, 0];

    public function solve(array $input = null)
    {
        $hull = new EmergencyHull();
        $memory = new MemoryWithSequentialIO($input ?? self::INPUT);
        $robot = new RobotPainter($this->createComputer(), $hull);

        $robot->paint($memory);

        return $hull->getPaintedCount();
    }

    public function createComputer(): IntcodeComputer
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
