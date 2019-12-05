<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class Add implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 1;
    }

    public function apply(Memory $memory): void
    {
        $position = $memory->getPointer();

        $resultPosition = $memory->get($position + 3);
        $input1 = $memory->getFromPosition($position + 1);
        $input2 = $memory->getFromPosition($position + 2);

        $memory->set($resultPosition, $input1 + $input2);
    }
}
