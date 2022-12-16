<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day15;

class Sensor
{
    public readonly int $range;

    public function __construct(
        public readonly Coordinates $location,
        public readonly Coordinates $nearestBeacon,
    ) {
        $this->range = $this->location->manhattan($this->nearestBeacon);
    }

    public function isWithinRange(Coordinates $coordinates): bool
    {
        return $this->location->manhattan($coordinates) <= $this->range;
    }
}
