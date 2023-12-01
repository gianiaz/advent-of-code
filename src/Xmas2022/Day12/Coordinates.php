<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day12;

class Coordinates
{
    public function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    /**
     * @return \Generator<self>
     */
    public function getNeighbours(): \Generator
    {
        yield new self($this->x, $this->y + 1);
        yield new self($this->x, $this->y - 1);
        yield new self($this->x + 1, $this->y);
        yield new self($this->x - 1, $this->y);
    }
}
