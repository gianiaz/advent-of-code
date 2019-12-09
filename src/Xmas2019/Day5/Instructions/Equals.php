<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use Jean85\AdventOfCode\Xmas2019\Day9\MemoryWithRelativeMode;

class Equals implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 8;
    }

    public function apply(Memory $memory, ParameterModes $modes): void
    {
        $valueToStore = $this->getValueToStore($memory, $modes);

        if ($modes->isRelative(3)) {
            if (! $memory instanceof MemoryWithRelativeMode) {
                throw new \InvalidArgumentException('Expecting ' . MemoryWithRelativeMode::class . ', got ' . get_class($memory));
            }

            $memory->set($memory->get($memory->getPointer() + 3) + $memory->getRelative(), $valueToStore);
        } else {
            $memory->set($memory->get($memory->getPointer() + 3), $valueToStore);
        }
    }

    public function getInstructionSize(): ?int
    {
        return 4;
    }

    protected function getValueToStore(Memory $memory, ParameterModes $modes): int
    {
        return (int) ($memory->getAfterPointer(1, $modes) === $memory->getAfterPointer(2, $modes));
    }
}
