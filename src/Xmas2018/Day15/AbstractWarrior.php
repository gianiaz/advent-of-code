<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

abstract class AbstractWarrior extends AbstractPosition
{
    public function moveTo(Distance $distance): void
    {
        $this->x = $distance->getX();
        $this->y = $distance->getY();
    }

    abstract public static function getSymbol(): string;

    public function __toString()
    {
        return static::getSymbol();
    }
}
