<?php

namespace Jean85\AdventOfCode\Xmas2018\Day13;

class Cart
{
    public const DIRECTION_UP = '^';
    public const DIRECTION_DOWN = 'v';
    public const DIRECTION_LEFT = '<';
    public const DIRECTION_RIGHT = '>';

    /** @var string */
    private $currentDirection;

    /** @var int */
    private $x;
    
    /** @var int */
    private $y;

    public function __construct(string $currentDirection, int $x, int $y)
    {
        $this->currentDirection = $currentDirection;
        $this->x = $x;
        $this->y = $y;
    }

    public function tick(): void
    {
        // TODO
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    public function __toString(): string
    {
        return $this->currentDirection;
    }

    public function getCoordHash(): string
    {
        return $this->x.'-'.$this->y;
    }
}
