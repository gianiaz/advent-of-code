<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day4;

use Jean85\AdventOfCode\Xmas2022\Day4\Day4Solution;
use PHPUnit\Framework\TestCase;

class Day4SolutionTest extends TestCase
{
    private const TEST_INPUT = '2-4,6-8
2-3,4-5
5-7,7-9
2-8,3-7
6-6,4-6
2-6,4-8';

    public function test(): void
    {
        $Day2Solution = new Day4Solution();

        $this->assertSame('2', $Day2Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day2Solution = new Day4Solution();

        $this->assertSame('70', $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
