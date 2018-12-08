<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day6;

use Jean85\AdventOfCode\Xmas2018\Day6\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    /**
     * @dataProvider getDistanceProvider
     */
    public function testGetDistance(int $expectedDistance, Point $a, Point $b): void
    {
        $this->assertSame($expectedDistance, $a->getDistance($b));
        $this->assertSame($expectedDistance, $b->getDistance($a));
    }

    public function getDistanceProvider()
    {
        return [
            [0, new Point(1, 1), new Point(1, 1)],
            [1, new Point(1, 1), new Point(1, 2)],
            [2, new Point(1, 1), new Point(2, 2)],
            [3, new Point(1, 1), new Point(0, 3)],
        ];
    }
}
