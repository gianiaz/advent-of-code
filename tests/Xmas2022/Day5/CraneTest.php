<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day5;

use Jean85\AdventOfCode\Xmas2022\Day5\Crane;
use Jean85\AdventOfCode\Xmas2022\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class CraneTest extends TestCase
{
    private const TEST_INPUT = '    [D]    
[N] [C]    
[Z] [M] [P]
 1   2   3 

move 1 from 2 to 1
move 3 from 1 to 3
move 2 from 2 to 1
move 1 from 1 to 2';

    public function testStacksParsing(): void
    {
        $crane = new Crane(self::TEST_INPUT);

        $expectedStacks = [
            1 => ['Z', 'N'],
            2 => ['M', 'C', 'D'],
            3 => ['P'],
        ];

        $this->assertEquals($expectedStacks, $crane->getStacks());
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day2Solution = new Day5Solution();

        $this->assertSame('4', $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
