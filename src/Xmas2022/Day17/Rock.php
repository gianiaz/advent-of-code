<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

abstract class Rock
{
    final public function __construct(
        protected Coordinates $origin,
    ) {
    }

    /**
     * All coordinates that compose the rock shape
     *
     * @return \Generator<Coordinates>
     */
    abstract public function getShape(): \Generator;

    public function push(JetStream $jetStream): void
    {
        $this->origin = $this->origin->withIncrease($jetStream, 0);
    }

    public function fallDown(): void
    {
        $this->origin = $this->origin->withIncrease(0, -1);
    }
}
