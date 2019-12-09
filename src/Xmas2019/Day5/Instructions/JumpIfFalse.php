<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class JumpIfFalse extends AbstractJump
{
    public function getOpcode(): int
    {
        return 6;
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

        $this->jumpSize = null;

        if (0 === $memory->getAfterPointer(1, $modes)) {
            $this->jumpSize = $memory->getAfterPointer(2, $modes) - $memory->getPointer();
        }
    }
}
