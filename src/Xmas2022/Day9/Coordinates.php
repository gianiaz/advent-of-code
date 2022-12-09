<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

class Coordinates
{
    public function __construct(
        private int $x = 0,
        private int $y = 0,
    ) {
    }

    public function move(Direction $direction): void
    {
        match ($direction) {
            Direction::Up => $this->y++,
            Direction::Down => $this->y--,
            Direction::Left => $this->x--,
            Direction::Right => $this->x++,
        };
    }

    public function isNotAdjacent(Coordinates $other): bool
    {
        return 1 < abs($this->x - $other->x)
            || 1 < abs($this->y - $other->y);
    }

    public function follow(Coordinates $head, Direction $direction): void
    {
        $this->x = match ($direction) {
            Direction::Up,
            Direction::Down => $head->x,
            Direction::Left => $head->x + 1,
            Direction::Right => $head->x - 1,
        };

        $this->y = match ($direction) {
            Direction::Up => $head->y - 1,
            Direction::Down => $head->y + 1,
            Direction::Left,
            Direction::Right => $head->y,
        };
    }
}
