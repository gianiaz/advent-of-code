<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day15;

class Scan
{
    /** @var Sensor[] */
    private array $sensors = [];

    /** @var string[][] */
    private array $map = [];
    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, $input) as $instruction) {
            if (1 !== \Safe\preg_match('/Sensor at x=(-?\d+), y=(-?\d+): closest beacon is at x=(-?\d+), y=(-?\d+)/', $instruction, $matches)) {
                throw new \InvalidArgumentException('Unable to parse: ' . $instruction);
            }

            $this->sensors[] = new Sensor(
                new Coordinates((int) $matches[1], (int) $matches[2]),
                new Coordinates((int) $matches[3], (int) $matches[4]),
            );
        }
    }

    public function countOccupiedPositionsAtRow(int $y): int
    {
        $this->markNoCloserBeaconPositions($y);

        return count(array_filter($this->map[$y], fn ($a): bool => $a === '#'));
    }

    private function markNoCloserBeaconPositions(int $willInspectRow): void
    {
        foreach ($this->sensors as $sensor) {
            $this->markSensorArea($sensor, $willInspectRow);
        }
    }

    private function markSensorArea(Sensor $sensor, int $willInspectRow): void
    {
        $sensorLocation = $sensor->location;
        $distance = $sensorLocation->manhattan($sensor->nearestBeacon);

        if (abs($willInspectRow - $sensor->location->y) > $distance) {
            return;
        }

        $this->map[$sensorLocation->y][$sensorLocation->x] = 'S';
        $this->map[$sensor->nearestBeacon->y][$sensor->nearestBeacon->x] = 'B';

        $y = $willInspectRow;
        $diff = $sensorLocation->y - $y;
        $diffX = $distance - abs($diff);
        foreach (range($sensorLocation->x - $diffX, $sensorLocation->x + $diffX) as $x) {
            $this->map[$y][$x] ??= '#';
        }
    }
}
