<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day5;

use Jean85\AdventOfCode\Xmas2022\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    private const TEST_INPUT = '    [D]    
[N] [C]    
[Z] [M] [P]
 1   2   3 

move 1 from 2 to 1
move 3 from 1 to 3
move 2 from 2 to 1
move 1 from 1 to 2';

    public function test(): void
    {
        $Day2Solution = new Day5Solution();

        $this->assertSame('CMZ', $Day2Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day2Solution = new Day5Solution();

        $this->assertSame('4', $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
