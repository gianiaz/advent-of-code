<?php

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode\GreaterThan;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractOpcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractWorkingOpcode;

class Gtri extends AbstractWorkingOpcode
{
    public function apply(AbstractOpcode $opcode, array $registry): array
    {
        $registry[$opcode->getC()] = (int) ($registry[$opcode->getA()] > $opcode->getB());

        return $registry;
    }
}
