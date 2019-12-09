<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class LessThan extends Equals implements InstructionInterface
{
    public function getOpcode(): int
    {
        return 7;
    }

    protected function getValueToStore(Memory $memory, ParameterModes $modes): int
    {
        return (int) ($memory->getAfterPointer(1, $modes) < $memory->getAfterPointer(2, $modes));
    }
}
