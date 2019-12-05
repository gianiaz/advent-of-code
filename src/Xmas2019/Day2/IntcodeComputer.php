<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Halt;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\ParameterModes;

class IntcodeComputer
{
    /** @var InstructionInterface[] */
    private $instructions;

    /** @var int */
    private $pointer;

    /**
     * @param InstructionInterface[] $instructions
     */
    public function __construct(array $instructions)
    {
        $this->instructions = $instructions;
    }

    public function run(Memory $memory): int
    {
        $this->pointer = 0;

        while ($instruction = $this->step($memory)) {
            if ($instruction instanceof Halt) {
                break;
            }

            $memory->increasePointer($instruction);
        }

        return $memory->get(0);
    }

    private function step(Memory $memory): InstructionInterface
    {
        $opcode = $this->getInstruction($memory);

        $opcode->apply($memory, new ParameterModes($memory));

        return $opcode;
    }

    private function getInstruction(Memory $memory): InstructionInterface
    {
        $opcode = (int) substr((string) $memory->getCurrent(), -2);

        foreach ($this->instructions as $instruction) {
            if ($opcode === $instruction->getOpcode()) {
                return $instruction;
            }
        }

        throw new \InvalidArgumentException(sprintf('Invalid opcode %d at position %d', $opcode, $memory->getPointer()));
    }
}
