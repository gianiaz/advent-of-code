<?php

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode;

class Opcode extends AbstractOpcode
{
    /** @var int */
    private $code;

    /**
     * Opcode constructor.
     * @param int $code
     * @param int $a
     * @param int $b
     * @param int $c
     */
    public function __construct(int $code, int $a, int $b, int $c)
    {
        parent::__construct($a, $b, $c);
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

}
