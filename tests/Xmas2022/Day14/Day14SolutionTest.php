<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day14;

use Jean85\AdventOfCode\Xmas2022\Day14\Day14Solution;
use PHPUnit\Framework\TestCase;

class Day14SolutionTest extends TestCase
{
    public const TEST_INPUT = '498,4 -> 498,6 -> 496,6
503,4 -> 502,4 -> 502,9 -> 494,9';

    public function test(): void
    {
        $solution = new Day14Solution();

        $this->assertSame('24', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $solution = new Day14Solution();

        $this->assertSame('93', trim($solution->solveSecondPart(self::TEST_INPUT)));
    }
}
