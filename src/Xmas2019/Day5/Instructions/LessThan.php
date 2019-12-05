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
        $valueToStore = (int) ($memory->getAfterPointer(1, $modes) < $memory->getAfterPointer(2, $modes));

        $memory->set($memory->get($memory->getPointer() + 3), $valueToStore);
    }

    public function getInstructionSize(): ?int
    {
        return 4;
    }
}
