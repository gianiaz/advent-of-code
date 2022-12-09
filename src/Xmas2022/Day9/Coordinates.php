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

    public function isAdjacent(Coordinates $head): bool
    {
        return true;
    }

    public function follow(Coordinates $head, Direction $direction): void
    {
    }
}
