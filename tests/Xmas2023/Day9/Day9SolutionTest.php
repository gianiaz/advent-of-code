<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day9;

use Jean85\AdventOfCode\Xmas2023\Day9\Day9Solution;
use PHPUnit\Framework\TestCase;

class Day9SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = '0 3 6 9 12 15
1 3 6 10 15 21
10 13 16 21 30 45';
        $Day9Solution = new Day9Solution();

        $this->assertSame('114', $Day9Solution->solve($input));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $input = '';
        $Day9Solution = new Day9Solution();

        $this->assertSame('6', $Day9Solution->solveSecondPart($input));
    }
}
