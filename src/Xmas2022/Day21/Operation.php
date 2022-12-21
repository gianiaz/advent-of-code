<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day21;

enum Operation: string
{
    case Add = '+';
    case Subtract = '-';
    case Multiply = '*';
    case Divide = '/';

    public function apply(int|float $a, int|float $b): int|float
    {
        return match ($this) {
            self::Add => $a + $b,
            self::Subtract => $a - $b,
            self::Multiply => $a * $b,
            self::Divide => $a / $b,
        };
    }

    public function reverse(float|int $target, int|float|UnresolvedMonkey $a, int|float|UnresolvedMonkey $b): int|float
    {
        if (gettype($a) === gettype($b)) {
            throw new \InvalidArgumentException();
        }

        $knownOperand = $a instanceof UnresolvedMonkey ? $b : $a;

        return match ($this) {
            self::Add => $target - $knownOperand,
            self::Subtract => match ($knownOperand) {
                $a => $knownOperand - $target,
                $b => $target + $knownOperand,
            },
            self::Multiply => $target / $knownOperand,
            self::Divide => match ($knownOperand) {
                $a => $knownOperand / $target,
                $b => $target * $knownOperand,
            },
        };
    }
}
