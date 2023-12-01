<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day1;

use Jean85\AdventOfCode\Xmas2023\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    private const TEST_INPUT = '1abc2
pqr3stu8vwx
a1b2c3d4e5f
treb7uchet';

    public function test(): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame('142', $day1Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $day1Solution = new Day1Solution();

        $this->assertSame('', $day1Solution->solveSecondPart(self::TEST_INPUT));
    }
}
