<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class LessThan implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 7;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        // TODO: Implement apply() method.
    }

    public function getInstructionSize(): ?int
    {
        return 4;
    }
}
