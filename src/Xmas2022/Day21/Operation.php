<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day21;

enum Operation: string
{
    case Add = '+';
    case Subtract = '-';
    case Multiply = '*';
    case Divide = '/';

    public function apply(int $a, int $b): int
    {
        return match ($this) {
            self::Add => $a + $b,
            self::Subtract => $a - $b,
            self::Multiply => $a * $b,
            self::Divide => $a / $b,
        };
    }
}
