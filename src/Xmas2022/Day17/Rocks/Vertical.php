<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17\Rocks;

use Jean85\AdventOfCode\Xmas2022\Day17\Rock;

class Vertical extends Rock
{
    public function getShape(): \Generator
    {
        yield $this->origin->withIncrease(0, 0);
        yield $this->origin->withIncrease(0, 1);
        yield $this->origin->withIncrease(0, 2);
        yield $this->origin->withIncrease(0, 3);
    }
}
