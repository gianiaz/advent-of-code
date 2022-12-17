<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Cross;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Horizontal;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\ReverseL;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Square;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Vertical;

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

    public static function getNext(Coordinates $origin): Rock
    {
        foreach (self::rockSequence() as $nextRock) {
            return new $nextRock($origin);
        }
    }

    public function push(JetStream $jetStream): void
    {
        $this->origin = $this->origin->withIncrease($jetStream, 0);
    }

    public function fallDown(): void
    {
        $this->origin = $this->origin->withIncrease(0, -1);
    }

    /**
     * @return \Generator<class-string<Rock>>
     */
    private static function rockSequence(): \Generator
    {
        do {
            yield Horizontal::class;
            yield Cross::class;
            yield ReverseL::class;
            yield Vertical::class;
            yield Square::class;
        } while (true);
    }
}
