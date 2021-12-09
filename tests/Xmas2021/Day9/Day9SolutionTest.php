<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day9;

use Jean85\AdventOfCode\Xmas2021\Day9\Day9Solution;
use PHPUnit\Framework\TestCase;

class Day9SolutionTest extends TestCase
{
    private const TEST_INPUT = '2199943210
3987894921
9856789892
8767896789
9899965678';

    public function test(): void
    {
        $day9Solution = new Day9Solution();

        $this->assertSame(15, $day9Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day9Solution = new Day9Solution();

        $this->assertSame(1134, $day9Solution->solveSecondPart(self::TEST_INPUT));
    }
}
