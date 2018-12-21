<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day16\Opcode;

class Opcode extends AbstractOpcode
{
    /** @var int */
    private $code;

    /**
     * Opcode constructor.
     */
    public function __construct(int $code, int $a, int $b, int $c)
    {
        parent::__construct($a, $b, $c);
        $this->code = $code;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
