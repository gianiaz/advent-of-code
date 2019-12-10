<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

class MonitoringStation
{
    /** @var AsteroidMap */
    private $map;

    public function __construct(AsteroidMap $map)
    {
        $this->map = $map;
    }

    public function getVisibleAsteroidCount(int $stationX, int $stationY): int
    {
        $visibleCount = 0;

        foreach ($this->map->getAsteroids() as $y => $row) {
            foreach ($row as $x => $asteroid) {
                if ($this->isVisible($stationX, $stationY, $x, $y)) {
                    ++$visibleCount;
                }
            }
        }

        return $visibleCount;
    }

    public function isVisible(int $x1, int $y1, int $x2, int $y2): bool
    {
        if ($x1 === $x2 && $y1 === $y2) {
            return false; // himself
        }

        if (abs($x1 - $x2) === 1 || abs($y1 - $y2) === 1) {
            return true; // slight disalignment, no possible blockers
        }

        if ($x1 === $x2) {
            // same column
            foreach ($this->createRange($y1, $y2) as $y) {
                if ($this->map->isAsteroid($x1, $y)) {
                    return false;
                }
            }

            return true;
        }

        if ($y1 === $y2) {
            // same row
            foreach ($this->createRange($x1, $x2) as $x) {
                if ($this->map->isAsteroid($x, $y1)) {
                    return false;
                }
            }

            return true;
        }

        $xRange = $this->createRange($x1, $x2);
        $yRange = $this->createRange($y1, $y2);

        foreach ($xRange as $x) {
            foreach ($yRange as $y) {
                if ($this->map->isAsteroid($x, $y)) {
                    return false;
                }
            }
        }

        return true;
    }

    private function createRange(int $x1, int $x2): array
    {
        $range = range($x1, $x2);
        array_pop($range);
        array_shift($range);

        return $range;
    }
}
