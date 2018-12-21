<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day16;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Opcode;

class Sample
{
    /** @var int[] */
    private $registersBefore;

    /** @var Opcode */
    private $opcode;
    /** @var int[] */
    private $registersAfter;

    /**
     * Sample constructor.
     *
     * @param int[] $registersBefore
     * @param int[] $registersAfter
     */
    public function __construct(array $registersBefore, Opcode $opcode, array $registersAfter)
    {
        $this->registersBefore = $registersBefore;
        $this->opcode = $opcode;
        $this->registersAfter = $registersAfter;
    }

    /**
     * @return int[]
     */
    public function getRegistersBefore(): array
    {
        return $this->registersBefore;
    }

    public function getOpcode(): Opcode
    {
        return $this->opcode;
    }

    /**
     * @return int[]
     */
    public function getRegistersAfter(): array
    {
        return $this->registersAfter;
    }
}
