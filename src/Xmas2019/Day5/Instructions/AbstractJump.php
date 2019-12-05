<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;

abstract class AbstractJump implements InstructionInterface
{
    /** @var int|null */
    protected $jumpSize;

    public function getJumpSize(): int
    {
        return $this->jumpSize ?? $this->getInstructionSize();
    }

    public function getInstructionSize(): ?int
    {
        return 3;
    }
}
