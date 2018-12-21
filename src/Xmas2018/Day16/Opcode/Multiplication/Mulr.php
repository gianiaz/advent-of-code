<?php

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Multiplication;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractOpcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractWorkingOpcode;

class Mulr extends AbstractWorkingOpcode
{
    public function apply(AbstractOpcode $opcode, array $registry): array
    {
        $registry[$opcode->getC()] = $registry[$opcode->getA()] * $registry[$opcode->getB()];

        return $registry;
    }
}
