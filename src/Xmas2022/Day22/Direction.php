<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day22;

enum Direction: int
{
    case Right = 0;
    case Down = 1;
    case Left = 2;
    case Up = 3;

    public function turn(Turn $turn): self
    {
        return self::from((4 + $this->value + $turn->toInt()) % 4);
    }

    public function toX(): int
    {
        return match ($this) {
            self::Right => 1,
            self::Down,
            self::Up => 0,
            self::Left => -1,
        };
    }

    public function toY(): int
    {
        return match ($this) {
            self::Down => 1,
            self::Up => -1,
            self::Left,
            self::Right => 0,
        };
    }

    public function toMap(): string
    {
        return match ($this) {
            self::Right => '>',
            self::Down => 'v',
            self::Left => '<',
            self::Up => '^',
        };
    }
}
