<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day6;

use Jean85\AdventOfCode\Xmas2021\Day6\Day6Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    private const TEST_INPUT = '3,4,3,1,2';

    public function test(): void
    {
        $day6Solution = new Day6Solution();

        $this->assertSame(5934, $day6Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day6Solution = new Day6Solution();

        $this->markTestIncomplete();
        $this->assertSame(12, $day6Solution->solveSecondPart(self::TEST_INPUT));
    }
}
