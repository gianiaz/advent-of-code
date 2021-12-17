<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day17;

class TargetArea
{
    private int $minX;
    private int $maxX;
    private int $minY;
    private int $maxY;

    public function __construct(string $input)
    {
        preg_match('/^target area: x=(-?\d+)\.\.(-?\d+), y=(-?\d+)\.\.(-?\d+)$/', $input, $matches);

        $this->minX = min((int) $matches[1], (int) $matches[2]);
        $this->maxX = max((int) $matches[1], (int) $matches[2]);
        $this->minY = min((int) $matches[3], (int) $matches[4]);
        $this->maxY = max((int) $matches[3], (int) $matches[4]);
    }

    public function getMinX(): int
    {
        return $this->minX;
    }

    public function getMaxX(): int
    {
        return $this->maxX;
    }

    public function getMinY(): int
    {
        return $this->minY;
    }

    public function getMaxY(): int
    {
        return $this->maxY;
    }

    public function isInside(int $x = null, int $y = null): bool
    {
        if ($x === null && $y === null) {
            throw new \InvalidArgumentException('both values are null');
        }

        if ($x !== null && ($x < $this->minX || $x > $this->maxX)) {
            return false;
        }

        if ($y !== null && ($y < $this->minY || $y > $this->maxY)) {
            return false;
        }

        return true;
    }
}
