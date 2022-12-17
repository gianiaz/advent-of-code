<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day17;

use Jean85\AdventOfCode\Xmas2022\Day17\Day17Solution;
use PHPUnit\Framework\TestCase;

class Day17SolutionTest extends TestCase
{
    public const TEST_INPUT = '>>><<><>><<<>><>>><<<>>><<<><<<>><>><<>>';

    public function test(): void
    {
        $solution = new Day17Solution();

        $this->assertSame('3068', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day17Solution();

        $this->assertSame('1651', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
