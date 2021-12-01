<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day1;

use Jean85\AdventOfCode\Xmas2021\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    private const TEST_INPUT = [199, 200, 208, 210, 200, 207, 240, 269, 260, 263];

    public function test(): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame(7, $day1Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame(5, $day1Solution->solveSecondPart(self::TEST_INPUT));
    }
}
