<?php

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Equality;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractOpcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractWorkingOpcode;

class Eqir extends AbstractWorkingOpcode
{
    public function apply(AbstractOpcode $opcode, array $registry): array
    {
        $registry[$opcode->getC()] = (int) ($opcode->getA() === $registry[$opcode->getB()]);

        return $registry;
    }
}
