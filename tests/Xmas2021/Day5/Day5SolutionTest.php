<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day5;

use Jean85\AdventOfCode\Xmas2021\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    private const TEST_INPUT = '0,9 -> 5,9
8,0 -> 0,8
9,4 -> 3,4
2,2 -> 2,1
7,0 -> 7,4
6,4 -> 2,0
0,9 -> 2,9
3,4 -> 1,4
0,0 -> 8,8
5,5 -> 8,2';

    public function test(): void
    {
        $day5Solution = new Day5Solution();

        $this->assertSame(5, $day5Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day5Solution = new Day5Solution();

        $this->markTestIncomplete();

        $this->assertSame(1924, $day5Solution->solveSecondPart(self::TEST_INPUT));
    }
}
