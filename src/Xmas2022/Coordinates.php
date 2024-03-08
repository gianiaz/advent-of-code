<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022;

class Coordinates
{
    public function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    public function getManhattanDistanceFrom(self $other): int
    {
        return abs($this->x - $other->x) + abs($this->y - $other->y);
    }
}
