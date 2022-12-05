<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day5;

use Jean85\AdventOfCode\Xmas2022\Day5\CrateMover9000;
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
        $crane = new CrateMover9000(self::TEST_INPUT);

        $expectedStacks = [
            1 => ['Z', 'N'],
            2 => ['M', 'C', 'D'],
            3 => ['P'],
        ];

        $this->assertEquals($expectedStacks, $crane->getStacks());
    }

    public function testInstructionsParsing(): void
    {
        $crane = new CrateMover9000(self::TEST_INPUT);

        $this->assertSame(1, $crane->getInstructions()[0]->quantity);
        $this->assertSame(2, $crane->getInstructions()[0]->from);
        $this->assertSame(1, $crane->getInstructions()[0]->to);
        $this->assertSame(3, $crane->getInstructions()[1]->quantity);
        $this->assertSame(1, $crane->getInstructions()[1]->from);
        $this->assertSame(3, $crane->getInstructions()[1]->to);
        $this->assertSame(2, $crane->getInstructions()[2]->quantity);
        $this->assertSame(2, $crane->getInstructions()[2]->from);
        $this->assertSame(1, $crane->getInstructions()[2]->to);
        $this->assertSame(1, $crane->getInstructions()[3]->quantity);
        $this->assertSame(1, $crane->getInstructions()[3]->from);
        $this->assertSame(2, $crane->getInstructions()[3]->to);
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day2Solution = new Day5Solution();

        $this->assertSame('4', $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
