<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day18;

use Jean85\AdventOfCode\Xmas2022\Day18\Day18Solution;
use PHPUnit\Framework\TestCase;

class Day18SolutionTest extends TestCase
{
    public const TEST_INPUT = '2,2,2
1,2,2
3,2,2
2,1,2
2,3,2
2,2,1
2,2,3
2,2,4
2,2,6
1,2,5
3,2,5
2,1,5
2,3,5';

    public function test(): void
    {
        $solution = new Day18Solution();

        $this->assertSame('64', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $solution = new Day18Solution();

        $this->assertGreaterThan(1514285714288, PHP_INT_MAX);

        $this->assertSame('58', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
