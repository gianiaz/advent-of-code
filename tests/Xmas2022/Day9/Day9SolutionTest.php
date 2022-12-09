<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day9;

use Jean85\AdventOfCode\Xmas2022\Day9\Day9Solution;
use PHPUnit\Framework\TestCase;

class Day9SolutionTest extends TestCase
{
    public const TEST_INPUT = 'R 4
U 4
L 3
D 1
R 4
D 1
L 5
R 2';

    public function test(): void
    {
        $solution = new Day9Solution();

        $this->assertSame('13', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day9Solution();

        $this->assertSame('8', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
