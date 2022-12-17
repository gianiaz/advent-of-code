<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

enum JetStream: string
{
    case Left = '<';
    case Right = '>';

    public function toDeltaX(): int
    {
        return match ($this) {
            self::Left => -1,
            self::Right => 1,
        };
    }
}
