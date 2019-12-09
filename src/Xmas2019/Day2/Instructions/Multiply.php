<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

class Multiply extends Add implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 2;
    }

    protected function getValueToBeSaved(int $input1, int $input2): int
    {
        return $input1 * $input2;
    }

    public function getInstructionSize(): ?int
    {
        return 4;
    }
}
