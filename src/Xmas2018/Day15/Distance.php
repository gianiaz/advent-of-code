<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Distance
{
    /** @var int */
    private $cost = 9999999;

    /** @var Distance[] */
    private $neighbors = [];

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

    public function forceRefresh(int $newNeighborCost): void
    {
        if ($newNeighborCost > $this->cost) {
            return;
        }

        if ($distance->cost < $this->cost) {
            $this->neighbors = [$distance];
            $this->cost = $distance->cost + 1;
        }

        if ($distance->cost === $this->cost) {
            $this->neighbors[] = $distance;
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
