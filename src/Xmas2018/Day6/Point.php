<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day6;

class Point
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getDistance(self $otherPoint): int
    {
        return abs($this->x - $otherPoint->x) + abs($this->y - $otherPoint->y);
    }
}
