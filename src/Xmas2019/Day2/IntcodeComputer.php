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

    /**
     * @param InstructionInterface[] $instructions
     */
    public function __construct(array $instructions)
    {
        foreach ($instructions as $instruction) {
            $this->instructions[$instruction->getOpcode()] = $instruction;
        }
    }

    public function run(Memory $memory): bool
    {
        while ($instruction = $this->step($memory)) {
            if ($instruction instanceof Halt) {
                return false;
            }

            $memory->increasePointer($instruction);
        }

        return true;
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

        if (! isset($this->instructions[$opcode])) {
            throw new \InvalidArgumentException(sprintf('Invalid opcode %d at position %d', $opcode, $memory->getPointer()));
        }

        return $this->instructions[$opcode];
    }
}
