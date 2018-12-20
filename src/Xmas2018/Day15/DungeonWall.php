<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class DungeonWall extends AbstractPosition
{
    /** @var int */
    protected $x;
    /** @var int */
    protected $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString()
    {
        return '#';
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getX(): int
    {
        return $this->x;
    }
}
