<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

abstract class AbstractWarrior
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /**
     * AbstractWarrior constructor.
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

    abstract public static function getSymbol(): string;

    public function __toString()
    {
        return static::getSymbol();
    }
}
