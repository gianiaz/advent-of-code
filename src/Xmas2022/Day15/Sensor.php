<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day15;

class Sensor
{
    public function __construct(
        public readonly Coordinates $location,
        public readonly Coordinates $nearestBeacon,
    ) {
    }
}
