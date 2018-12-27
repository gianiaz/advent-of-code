<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day19;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractOpcode;

class Opcode extends AbstractOpcode
{
    /** @var string */
    private $code;

    public function __construct(string $code, int $a, int $b, int $c)
    {
        parent::__construct($a, $b, $c);
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
