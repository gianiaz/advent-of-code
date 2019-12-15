<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day12;

class Coordinates
{
    /** @var int */
    public $x = 0;

    /** @var int */
    public $y = 0;

    /** @var int */
    public $z = 0;

    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }
}
