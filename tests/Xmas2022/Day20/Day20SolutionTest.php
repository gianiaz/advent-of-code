<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day20;

use Jean85\AdventOfCode\Xmas2022\Day20\Day20Solution;
use PHPUnit\Framework\TestCase;

class Day20SolutionTest extends TestCase
{
    public const TEST_INPUT = '1
2
-3
3
-2
0
4';

    public function test(): void
    {
        $this->markTestIncomplete();
        $solution = new Day20Solution();

        $this->assertSame('3', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day20Solution();

        $this->assertGreaterThan(1514285714288, PHP_INT_MAX);

        $this->assertSame('58', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
