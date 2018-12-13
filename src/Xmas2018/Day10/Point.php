<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day10;

class Point
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var int */
    private $speedX;

    /** @var int */
    private $speedY;

    /**
     * Point constructor.
     */
    public function __construct(int $x, int $y, int $speedX, int $speedY)
    {
        $this->x = $x;
        $this->y = $y;
        $this->speedX = $speedX;
        $this->speedY = $speedY;
    }

    public function move(): void
    {
        $this->x += $this->speedX;
        $this->y += $this->speedY;
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
