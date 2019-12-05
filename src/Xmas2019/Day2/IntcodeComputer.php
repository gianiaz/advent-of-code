<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Halt;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\InstructionInterface;

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

        while ($this->step($memory)) {
            $this->pointer += 4;
        }

        return $memory->get(0);
    }

    private function step(Memory $memory): bool
    {
        $opcode = $this->getInstruction($memory);

        $opcode->apply($memory, $this->pointer);

        return ! $opcode instanceof Halt;
    }

    private function getInstruction(Memory $memory): InstructionInterface
    {
        $opcode = $memory->get($this->pointer);

        foreach ($this->instructions as $instruction) {
            if ($opcode === $instruction->getOpcode()) {
                return $instruction;
            }
        }

        throw new \InvalidArgumentException(sprintf('Invalid opcode %d at position %d', $opcode, $this->pointer));
    }
}
