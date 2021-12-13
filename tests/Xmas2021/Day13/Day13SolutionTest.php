<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day13;

use Jean85\AdventOfCode\Xmas2021\Day13\Day13Solution;
use PHPUnit\Framework\TestCase;

class Day13SolutionTest extends TestCase
{
    public const TEST_INPUT = '6,10
0,14
9,10
0,3
10,4
4,11
6,0
6,12
4,1
0,13
10,12
3,4
3,0
8,4
1,10
2,14
8,10
9,0

fold along y=7
fold along x=5';

    public function test(): void
    {
        $day13Solution = new Day13Solution();

        $this->assertSame(17, $day13Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day13Solution = new Day13Solution();

        $this->markTestIncomplete();
        $this->assertSame(36, $day13Solution->solveSecondPart(self::TEST_INPUT));
    }
}
