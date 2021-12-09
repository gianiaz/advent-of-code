<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day7;

use Jean85\AdventOfCode\Xmas2021\Day7\Day7Solution;
use PHPUnit\Framework\TestCase;

class Day7SolutionTest extends TestCase
{
    private const TEST_INPUT = '16,1,2,0,4,2,7,1,2,14';

    public function test(): void
    {
        $day7Solution = new Day7Solution();

        $this->assertSame(37, $day7Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day7Solution = new Day7Solution();

        $this->assertSame(168, $day7Solution->solveSecondPart(self::TEST_INPUT));
    }
}
