<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Distance
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var int */
    private $cost = 9999999;

    /** @var Distance[] */
    private $neighbors = [];

    /**
     * Distance constructor.
     */
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

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        if ($cost > $this->cost) {
            return;
        }

        $this->cost = $cost;

        foreach ($this->neighbors as $neighbor) {
            $neighbor->setCost($cost + 1);
        }
    }

    /**
     * @return Distance[]
     */
    public function getNeighbors(): array
    {
        return $this->neighbors;
    }

    public function addNeighbor(self $new): void
    {
        $this->neighbors[] = $new;
    }
}
