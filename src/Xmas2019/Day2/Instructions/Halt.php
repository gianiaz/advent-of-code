<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\ParameterModes;

class Halt implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 99;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        return;
    }

    public function getInstructionSize(): ?int
    {
        return 0;
    }
}
