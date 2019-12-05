<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class Multiply implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 2;
    }

    public function apply(Memory $memory, int $position): void
    {
        $resultPosition = $memory->get($position + 3);
        $input1 = $memory->getFromPosition($position + 1);
        $input2 = $memory->getFromPosition($position + 2);

        $memory->set($resultPosition, $input1 * $input2);
    }
}
