<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

class MonitoringStation
{
    /** @var AsteroidMap */
    private $map;

    /** @var Asteroid */
    private $bestPosition;

    public function __construct(AsteroidMap $map)
    {
        $this->map = $map;
    }

    public function getMap(): AsteroidMap
    {
        return $this->map;
    }

    public function getBestPosition(): Asteroid
    {
        return $this->bestPosition;
    }

    public function calculateBestPosition(): int
    {
        $bestVisibility = 0;

        foreach ($this->map->getAsteroids() as $asteroid) {
            $visibleAsteroidCount = $this->getVisibleAsteroidCount($asteroid->getX(), $asteroid->getY());

            if ($bestVisibility < $visibleAsteroidCount) {
                $bestVisibility = max($bestVisibility, $visibleAsteroidCount);
                $this->bestPosition = $asteroid;
            }
        }

        return $bestVisibility;
    }

    public function getVisibleAsteroidCount(int $stationX, int $stationY): int
    {
        $visibleCount = 0;

        foreach ($this->map->getAsteroids() as $asteroid) {
            if ($this->isVisible($stationX, $stationY, $asteroid)) {
                ++$visibleCount;
            }
        }

        return $visibleCount;
    }

    public function isVisible(int $x1, int $y1, Asteroid $asteroid): bool
    {
        if ($x1 === $asteroid->getX() && $y1 === $asteroid->getY()) {
            return false; // himself
        }

        if ($x1 === $asteroid->getX()) {
            // same column
            foreach ($this->createRange($y1, $asteroid->getY()) as $y) {
                if ($this->map->isAsteroid($x1, $y)) {
                    return false;
                }
            }

            return true;
        }

        if ($y1 === $asteroid->getY()) {
            // same row
            foreach ($this->createRange($x1, $asteroid->getX()) as $x) {
                if ($this->map->isAsteroid($x, $y1)) {
                    return false;
                }
            }

            return true;
        }

        $xRange = $this->createRange($x1, $asteroid->getX());
        $yRange = $this->createRange($y1, $asteroid->getY());

        $blocksLineOfSight = function (int $x, int $y) use ($x1, $y1, $asteroid) {
            $leftHandEquation = ($x - $x1) / ($asteroid->getX() - $x1);
            $rightHandEquation = ($y - $y1) / ($asteroid->getY() - $y1);

            return $leftHandEquation === $rightHandEquation;
        };

        foreach ($xRange as $x) {
            foreach ($yRange as $y) {
                if ($this->map->isAsteroid($x, $y) && $blocksLineOfSight($x, $y)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return int[]
     */
    private function createRange(int $x1, int $x2): array
    {
        $range = range($x1, $x2);
        array_pop($range);
        array_shift($range);

        return $range;
    }
}
