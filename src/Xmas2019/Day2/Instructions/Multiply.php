<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\ParameterModes;

class Multiply implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 2;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        if (
            $modes->isRelative(1)
            || $modes->isRelative(2)
            || $modes->isRelative(3)

        ) {
            throw new \InvalidArgumentException();
        }

        $resultPosition = $memory->get($memory->getPointer() + 3);
        $input1 = $memory->getAfterPointer(1, $modes);
        $input2 = $memory->getAfterPointer(2, $modes);

        $memory->set($resultPosition, $input1 * $input2);
    }

    public function getInstructionSize(): ?int
    {
        return 4;
    }
}
