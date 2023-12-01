<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day22;

enum Turn: string
{
    case Right = 'R';
    case Left = 'L';

    public function toInt(): int
    {
        return match ($this) {
            self::Right => 1,
            self::Left => -1,
        };
    }

    public function opposite(): self
    {
        return match ($this) {
            self::Right => self::Left,
            self::Left => self::Right,
        };
    }
}
