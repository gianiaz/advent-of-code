<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day8;

class GameConsole
{
    /** @var Instruction[] */
    private array $instructions = [];
    private int $accumulator = 0;

    public function __construct(array $instructions)
    {
        $this->instructions = $instructions;
    }

    public function run(): void
    {
        $program = $this->instructions;
        $this->accumulator = 0;
        $i = 0;

        while ($program[$i] ?? false) {
            $instruction = $program[$i];
            switch ($instruction->getCommand()) {
                case 'acc':
                    $this->accumulator += $instruction->getArgument();
                    break;
                case 'jmp':
                    $i += $instruction->getArgument() - 1;
                    break;
                case 'nop':
                    break;
                default:
                    throw new \InvalidArgumentException($instruction->getCommand());
            }
            unset($program[$i]);
            ++$i;
        }
    }

    public function runToTermination(array $program): bool
    {
        $this->accumulator = 0;
        $i = 0;

        while ($program[$i] ?? false) {
            $instruction = $program[$i];
            unset($program[$i]);
            switch ($instruction->getCommand()) {
                case 'acc':
                    $this->accumulator += $instruction->getArgument();
                    break;
                case 'jmp':
                    $i += $instruction->getArgument() - 1;
                    break;
                case 'nop':
                    break;
                default:
                    throw new \InvalidArgumentException($instruction->getCommand());
            }

            ++$i;
        }

        return $i === count($this->instructions);
    }

    public function getAccumulator(): int
    {
        return $this->accumulator;
    }
}
