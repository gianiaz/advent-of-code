<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

abstract class AbstractPosition
{
    abstract public function getX(): int;

    abstract public function getY(): int;

    public function compareTo(AbstractPosition $other): int
    {
        return $this->compareByReadingOrder($other);
    }

    public function compareByReadingOrder(AbstractPosition $other): int
    {
        $compareY = $this->getY() <=> $other->getY();

        if ($compareY !== 0) {
            return $compareY;
        }

        return $this->getX() <=> $other->getX();
    }
}
