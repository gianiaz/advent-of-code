<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day7;

enum Card: string
{
    case A = 'A';
    case K = 'K';
    case Q = 'Q';
    case J = 'J';
    case T = 'T';
    case n9 = '9';
    case n8 = '8';
    case n7 = '7';
    case n6 = '6';
    case n5 = '5';
    case n4 = '4';
    case n3 = '3';
    case n2 = '2';

    public function getRank(): int
    {
        return match ($this) {
            self::A => 13,
            self::K => 12,
            self::Q => 11,
            self::J => 10,
            self::T => 9,
            self::n9 => 8,
            self::n8 => 7,
            self::n7 => 6,
            self::n6 => 5,
            self::n5 => 4,
            self::n4 => 3,
            self::n3 => 2,
            self::n2 => 1,
        };
    }
}
