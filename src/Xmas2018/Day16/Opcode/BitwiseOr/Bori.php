<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode\BitwiseOr;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractOpcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractWorkingOpcode;

class Bori extends AbstractWorkingOpcode
{
    public function apply(AbstractOpcode $opcode, array $registry): array
    {
        $registry[$opcode->getC()] = $registry[$opcode->getA()] | $opcode->getB();

        return $registry;
    }
}
