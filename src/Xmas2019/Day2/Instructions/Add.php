<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\ParameterModes;
use Jean85\AdventOfCode\Xmas2019\Day9\MemoryWithRelativeMode;

class Add implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 1;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        $resultPosition = $memory->get($memory->getPointer() + 3);
        $input1 = $memory->getAfterPointer(1, $modes);
        $input2 = $memory->getAfterPointer(2, $modes);

        if ($modes->isRelative(3)) {
            if (! $memory instanceof MemoryWithRelativeMode) {
                throw new \InvalidArgumentException('Expecting ' . MemoryWithRelativeMode::class . ', got ' . get_class($memory));
            }

            $memory->set($resultPosition + $memory->getRelative(), $input1 + $input2);
        } else {
            $memory->set($resultPosition, $input1 + $input2);
        }
    }

    public function getInstructionSize(): ?int
    {
        return 4;
    }
}
