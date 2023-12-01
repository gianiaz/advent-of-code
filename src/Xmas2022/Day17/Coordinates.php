<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

class Coordinates
{
    public function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    public function withIncrease(int|JetStream $deltaX, int $deltaY): self
    {
        if ($deltaX instanceof JetStream) {
            $deltaX = $deltaX->toDeltaX();
        }

        return new self(
            $this->x + $deltaX,
            $this->y + $deltaY,
        );
    }
}
