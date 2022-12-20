<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day19;

use Jean85\AdventOfCode\Xmas2022\Day19\Day19Solution;
use PHPUnit\Framework\TestCase;

class Day19SolutionTest extends TestCase
{
    public const TEST_INPUT = 'Blueprint 1: Each ore robot costs 4 ore. Each clay robot costs 2 ore. Each obsidian robot costs 3 ore and 14 clay. Each geode robot costs 2 ore and 7 obsidian.
Blueprint 2: Each ore robot costs 2 ore. Each clay robot costs 3 ore. Each obsidian robot costs 3 ore and 8 clay. Each geode robot costs 3 ore and 12 obsidian.';

    public function test(): void
    {
        $this->markTestIncomplete();
        $solution = new Day19Solution();

        $this->assertSame('33', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day19Solution();

        $this->assertGreaterThan(1514285714288, PHP_INT_MAX);

        $this->assertSame('58', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
