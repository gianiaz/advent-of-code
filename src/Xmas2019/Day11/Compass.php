<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day11;

class Compass
{
    /** @var array<int, Direction> */
    private $directions;

    /** @var int */
    private $currentDirection;

    public function __construct()
    {
        $this->currentDirection = 0;
        $this->directions = [
            Direction::up(),
            Direction::right(),
            Direction::down(),
            Direction::left(),
        ];
    }

    public function nextDirection(int $output): Direction
    {
        $deviation = ($output * 2) - 1;
        $this->currentDirection += $deviation;

        if ($this->currentDirection < 0) {
            $this->currentDirection += 4;
        }

        return $this->directions[$this->currentDirection % 4];
    }
}
