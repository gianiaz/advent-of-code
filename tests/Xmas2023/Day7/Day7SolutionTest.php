<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day7;

use Jean85\AdventOfCode\Xmas2023\Day7\Day7Solution;
use PHPUnit\Framework\TestCase;

class Day7SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = '32T3K 765
T55J5 684
KK677 28
KTJJT 220
QQQJA 483';
        $Day7Solution = new Day7Solution();

        $this->assertSame('6440', $Day7Solution->solve($input));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $input = '';
        $Day7Solution = new Day7Solution();

        $this->assertSame('6', $Day7Solution->solveSecondPart($input));
    }
}
