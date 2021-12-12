<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day12;

use Jean85\AdventOfCode\Xmas2021\Day12\Day12Solution;
use PHPUnit\Framework\TestCase;

class Day12SolutionTest extends TestCase
{
    public const TEST_INPUT = 'start-A
start-b
A-c
A-b
b-d
A-end
b-end';

    public function test(): void
    {
        $day12Solution = new Day12Solution();

        $this->assertSame(10, $day12Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day12Solution = new Day12Solution();

        $this->markTestIncomplete();
        $this->assertSame(195, $day12Solution->solveSecondPart(self::TEST_INPUT));
    }
}
