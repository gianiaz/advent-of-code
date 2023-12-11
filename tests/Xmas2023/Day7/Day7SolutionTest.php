<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day7;

use Jean85\AdventOfCode\Xmas2023\Day7\Day7Solution;
use PHPUnit\Framework\TestCase;

class Day7SolutionTest extends TestCase
{
    public function test(): void
    {
        $Day7Solution = new Day7Solution();

        $this->assertSame('6440', $Day7Solution->solve($this->getInput()));
    }

    public function testSecondPart(): void
    {
        $Day7Solution = new Day7Solution();

        $this->assertSame('5905', $Day7Solution->solveSecondPart($this->getInput()));
    }

    private function getInput(): string
    {
        return '32T3K 765
T55J5 684
KK677 28
KTJJT 220
QQQJA 483';
    }
}
