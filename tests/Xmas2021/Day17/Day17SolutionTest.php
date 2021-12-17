<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day17;

use Jean85\AdventOfCode\Xmas2021\Day17\Day17Solution;
use PHPUnit\Framework\TestCase;

class Day17SolutionTest extends TestCase
{
    private const TEST_INPUT = 'target area: x=20..30, y=-10..-5';

    public function test(): void
    {
        $day17Solution = new Day17Solution();

        $this->assertSame(45, $day17Solution->solve(self::TEST_INPUT));
    }
}
