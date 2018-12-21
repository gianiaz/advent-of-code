<?php

declare(strict_types=1);

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
     */
    public function __construct(int $a, int $b, int $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getC(): int
    {
        return $this->c;
    }
}
