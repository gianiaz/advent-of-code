<?php

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode;

abstract class AbstractWorkingOpcode
{
    abstract public function apply(AbstractOpcode $opcode, array $registry): array;
}
