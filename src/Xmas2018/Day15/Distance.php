<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Distance extends AbstractPosition
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

    public function compareTo(AbstractPosition $other): int
    {
        if (! $other instanceof self) {
            throw new \InvalidArgumentException('Not comparable: ' . \get_class($other));
        }

        $compare = $this->getCost() <=> $other->getCost();

        if ($compare !== 0) {
            return $compare;
        }

        return parent::compareTo($other);
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
