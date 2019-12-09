<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day9\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\ParameterModes;
use Jean85\AdventOfCode\Xmas2019\Day9\MemoryWithRelativeMode;

class AdjustRelativeBase implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 9;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        if (! $memory instanceof MemoryWithRelativeMode) {
            throw new \InvalidArgumentException('Expecting MemoryWithRelativeMode, got ' . get_class($memory));
        }

        $diff = $memory->getAfterPointer(1, $modes);
        $memory->alterRelative($diff);
    }

    public function getInstructionSize(): ?int
    {
        return 2;
    }
}
