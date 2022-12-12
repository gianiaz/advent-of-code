<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day12;

use Jean85\AdventOfCode\Xmas2022\Day12\Day12Solution;
use PHPUnit\Framework\TestCase;

class Day12SolutionTest extends TestCase
{
    public const TEST_INPUT = 'Sabqponm
abcryxxl
accszExk
acctuvwj
abdefghi';

    public function test(): void
    {
        $solution = new Day12Solution();

        $this->assertSame('31', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day12Solution();

        $this->assertSame($expectedOutput, trim($solution->solveSecondPart(self::TEST_INPUT)));
    }
}
