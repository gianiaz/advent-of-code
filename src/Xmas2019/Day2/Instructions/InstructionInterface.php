<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

interface InstructionInterface
{
    public function getOpcode(): int;

    public function apply(Memory $memory, int $position): void;
}
