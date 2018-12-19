<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

abstract class AbstractPosition
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

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function compareTo(AbstractPosition $other): int
    {
        return $this->compareByDistanceOnly($other);
    }

    public function compareByDistanceOnly(AbstractPosition $other): int
    {
        $compareY = $this->getY() <=> $other->getY();

        if ($compareY !== 0) {
            return $compareY;
        }

        return $this->getX() <=> $other->getX();
    }
}
