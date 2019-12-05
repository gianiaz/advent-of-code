<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;

class SaveFromInput implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 3;
    }

    public function apply(Memory $memory): void
    {
        if (! $memory instanceof MemoryWithIO) {
            throw new \InvalidArgumentException('Expecting ' . MemoryWithIO::class . ', got ' . get_class($memory));
        }

        $address = $memory->get($memory->getPointer() + 1);

        $memory->set($address, $memory->getInput());
    }

    public function getInstructionSize(): ?int
    {
        return 2;
    }
}
