<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;

class PushInOutput implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 4;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        if (! $memory instanceof MemoryWithIO) {
            throw new \InvalidArgumentException('Expecting ' . MemoryWithIO::class . ', got ' . get_class($memory));
        }

        $value = $memory->getAfterPointer(1, $modes);

        $memory->setOutput($value);
    }

    public function getInstructionSize(): ?int
    {
        return 2;
    }
}
