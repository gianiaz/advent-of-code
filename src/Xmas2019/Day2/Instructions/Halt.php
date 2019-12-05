<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class Halt implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 99;
    }

    public function apply(Memory $memory): void
    {
        return;
    }
}
