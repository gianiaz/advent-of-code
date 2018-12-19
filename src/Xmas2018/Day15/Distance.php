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

        $costForNeighbours = $cost + 1;
        foreach ($this->neighbors as $neighbor) {
            if ($costForNeighbours < $neighbor->cost) {
                $neighbor->cost = $costForNeighbours;
            }
        }

        foreach ($this->neighbors as $neighbor) {
            $neighbor->setCost($costForNeighbours);
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

    public function findStepToward(): ?self
    {
        if ($this->cost === 1) {
            return $this;
        }
        $cost = $this->cost;
        $neighborsWithLesserCost = \array_filter($this->neighbors, function (self $a) use ($cost) {
            return $a->cost < $cost;
        });
        
        $firstStepToward = \array_map(function (self $a) {
            return $a->findStepToward();
        }, \array_filter($neighborsWithLesserCost));

        \usort($firstStepToward, function (self $a, self $b) {
            return $a->compareTo($b);
        });

        return array_shift($firstStepToward);
    }
}
