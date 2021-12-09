<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day6;

use Jean85\AdventOfCode\Xmas2021\Day6\Day7Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    private const TEST_INPUT = '3,4,3,1,2';

    /**
     * @dataProvider projectionSmallDataProvider
     */
    public function testProjectionInALimitedSet(int $expected, int $start, int $days): void
    {
        $day6Solution = new Day7Solution();

        $this->assertSame($expected, $day6Solution->projectFishes((string) $start, $days));
    }

    /**
     * @return array{int, int, int}[]
     */
    public function projectionSmallDataProvider(): array
    {
        return [
            [1, 6, 6],
            [2, 6, 7],
            [2, 6, 13],
            [3, 6, 14],
            [3, 6, 15],
            [4, 6, 16],
            [4, 6, 20],
            [5, 6, 21],
        ];
    }

    /**
     * @dataProvider projectionDataProvider
     */
    public function testProjection(int $days, int $expectedProjection): void
    {
        $day6Solution = new Day7Solution();

        $this->assertSame($expectedProjection, $day6Solution->projectFishes(self::TEST_INPUT, $days));
    }

    /**
     * @return array{int,int}[]
     */
    public function projectionDataProvider(): array
    {
        return [
            [18, 26],
        ];
    }

    public function test(): void
    {
        $day6Solution = new Day7Solution();

        $this->assertSame(5934, $day6Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day6Solution = new Day7Solution();

        $this->assertSame(26984457539, $day6Solution->solveSecondPart(self::TEST_INPUT));
    }
}
