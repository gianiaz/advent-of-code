<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day15;

use Jean85\AdventOfCode\Xmas2022\Day15\Coordinates;
use Jean85\AdventOfCode\Xmas2022\Day15\Scan;
use PHPUnit\Framework\TestCase;

class Day15SolutionTest extends TestCase
{
    public const TEST_INPUT = 'Sensor at x=2, y=18: closest beacon is at x=-2, y=15
Sensor at x=9, y=16: closest beacon is at x=10, y=16
Sensor at x=13, y=2: closest beacon is at x=15, y=3
Sensor at x=12, y=14: closest beacon is at x=10, y=16
Sensor at x=10, y=20: closest beacon is at x=10, y=16
Sensor at x=14, y=17: closest beacon is at x=10, y=16
Sensor at x=8, y=7: closest beacon is at x=2, y=10
Sensor at x=2, y=0: closest beacon is at x=2, y=10
Sensor at x=0, y=11: closest beacon is at x=2, y=10
Sensor at x=20, y=14: closest beacon is at x=25, y=17
Sensor at x=17, y=20: closest beacon is at x=21, y=22
Sensor at x=16, y=7: closest beacon is at x=15, y=3
Sensor at x=14, y=3: closest beacon is at x=15, y=3
Sensor at x=20, y=1: closest beacon is at x=15, y=3';

    public function test(): void
    {
        $scan = new Scan(self::TEST_INPUT);

        $this->assertSame(26, $scan->countOccupiedPositionsAtRow(10));
    }

    public function testSecondPart(): void
    {
        $scan = new Scan(self::TEST_INPUT);

        $this->assertEquals(new Coordinates(14, 11), $scan->findMissingBeacon(20), $scan->printMap(20));
    }
}
