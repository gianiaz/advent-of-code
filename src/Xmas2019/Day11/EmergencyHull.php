<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day11;

class EmergencyHull
{
    public const BLACK = 0;
    public const WHITE = 1;

    /** @var int[][] */
    private $panels = [];

    /** @var int */
    private $paintedCount = 0;

    public function getColor(int $x, int $y): int
    {
        return $this->panels[$y][$x] ?? self::BLACK;
    }

    public function paint(int $x, int $y, int $color): void
    {
        if (! isset($this->panels[$y][$x])) {
            ++$this->paintedCount;
        }

        $this->panels[$y][$x] = $color;
    }

    public function getPaintedCount(): int
    {
        return $this->paintedCount;
    }
}
