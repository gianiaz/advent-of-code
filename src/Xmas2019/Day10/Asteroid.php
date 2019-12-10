<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

class Asteroid
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
}
