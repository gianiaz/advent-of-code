<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day11;

class Operation
{
    private string $operator;
    private ?int $operand;

    public function __construct(string $input)
    {
        \Safe\preg_match('/Operation: new = old (\+|\*) (\d+|(?>old))/', $input, $matches);
        $this->operator = $matches[1];
        $this->operand = $matches[2] === 'old'
            ? null
            : (int) $matches[2]
        ;
    }

    public function apply(int $old): int
    {
        $secondOperand = $this->operand ?? $old;

        return match ($this->operator) {
            '+' => $old + $secondOperand,
            '*' => $old * $secondOperand,
        };
    }
}
