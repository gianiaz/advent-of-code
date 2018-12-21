<?php

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode;

abstract class AbstractOpcode
{
    /** @var int */
    private $a;
    /** @var int */
    private $b;
    /** @var int */
    private $c;

    /**
     * AbstractOpcode constructor.
     * @param int $a
     * @param int $b
     * @param int $c
     */
    public function __construct(int $a, int $b, int $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    /**
     * @return int
     */
    public function getB(): int
    {
        return $this->b;
    }

    /**
     * @return int
     */
    public function getA(): int
    {
        return $this->a;
    }

    /**
     * @return int
     */
    public function getC(): int
    {
        return $this->c;
    }
}
