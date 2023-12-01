<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

class Coordinates
{
    public function __construct(
        private int $x = 0,
        private int $y = 0,
    ) {}

    public function move(Direction $direction): void
    {
        match ($direction) {
            Direction::Up => $this->y++,
            Direction::Down => $this->y--,
            Direction::Left => $this->x--,
            Direction::Right => $this->x++,
        };
    }

    public function follow(Coordinates $head): void
    {
        $distance = $this->manhattanDistance($head);

        if ($distance <= 1) {
            return;
        }

        $diffX = $head->x - $this->x;
        if ($distance > 2 || abs($diffX) > 1) {
            $this->x += $diffX > 0
                ? 1
                : -1
            ;
        }

        $diffY = $head->y - $this->y;
        if ($distance > 2 || abs($diffY) > 1) {
            $this->y += $diffY > 0
                ? 1
                : -1
            ;
        }
    }

    public function __toString(): string
    {
        return $this->x . '-' . $this->y;
    }

    /**
     * @return positive-int
     */
    private function manhattanDistance(Coordinates $other): int
    {
        return abs($this->x - $other->x)
            + abs($this->y - $other->y);
    }
}
