<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day18;

class Cube
{
    public function __construct(
        public readonly int $x,
        public readonly int $y,
        public readonly int $z,
        public bool $isReachedBySteam = false,
    ) {}

    /**
     * @return \Generator<self>
     */
    public function getNeighbours(): \Generator
    {
        yield new self($this->x + 1, $this->y, $this->z);
        if ($this->x >= 0) {
            yield new self($this->x - 1, $this->y, $this->z);
        }

        yield new self($this->x, $this->y + 1, $this->z);
        if ($this->y >= 0) {
            yield new self($this->x, $this->y - 1, $this->z);
        }

        yield new self($this->x, $this->y, $this->z + 1);
        if ($this->z >= 0) {
            yield new self($this->x, $this->y, $this->z - 1);
        }
    }

    public function getVapor(): self
    {
        $vapor = clone $this;
        $vapor->isReachedBySteam = true;

        return $vapor;
    }
}
