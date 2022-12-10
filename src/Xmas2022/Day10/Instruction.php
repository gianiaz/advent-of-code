<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day10;

class Instruction
{
    private int $remainingCycles;

    public static function parse(string $input): self
    {
        if ($input === 'noop') {
            return new self(1, 0);
        }

        if (1 !== \Safe\preg_match('/addx (-?\d+)/', $input, $matches)) {
            throw new \InvalidArgumentException('Unable to parse instruction: ' . $input);
        }

        return new self(2, (int) $matches[1]);
    }

    private function __construct(
        public readonly int $cycleCost,
        public readonly int $value,
    ) {
        $this->remainingCycles = $this->cycleCost;
    }

    public function tick(): void
    {
        --$this->remainingCycles;
    }

    public function isCompleted(): bool
    {
        return $this->remainingCycles <= 0;
    }
}
