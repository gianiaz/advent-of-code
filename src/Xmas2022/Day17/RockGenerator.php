<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Cross;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Horizontal;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\ReverseL;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Square;
use Jean85\AdventOfCode\Xmas2022\Day17\Rocks\Vertical;

class RockGenerator
{
    /** @var \Generator<Rock> */
    private \Generator $generator;
    private bool $isStarted = false;

    public function __construct()
    {
        $this->generator = $this->initGenerator();
    }

    public function next(Coordinates $origin): Rock
    {
        if ($this->isStarted) {
            $this->generator->next();
        } else {
            $this->isStarted = true;
        }

        $rockClass = $this->generator->current();

        return new $rockClass($origin);
    }

    /**
     * @return \Generator<class-string<Rock>>
     */
    private function initGenerator(): \Generator
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
