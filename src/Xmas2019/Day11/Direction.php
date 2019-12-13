<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day11;

class Direction
{
    /** @var int */
    private $x = 0;

    /** @var int */
    private $y = 0;

    public static function up(): self
    {
        $direction = new self();
        $direction->y = -1;

        return $direction;
    }

    public static function down(): self
    {
        $direction = new self();
        $direction->y = 1;

        return $direction;
    }

    public static function left(): self
    {
        $direction = new self();
        $direction->x = -1;

        return $direction;
    }

    public static function right(): self
    {
        $direction = new self();
        $direction->x = 1;

        return $direction;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}
