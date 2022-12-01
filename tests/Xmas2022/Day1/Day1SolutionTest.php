<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day1;

use Jean85\AdventOfCode\Xmas2022\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    private const TEST_INPUT = '1000
2000
3000

4000

5000
6000

7000
8000
9000

10000

';

    public function test(): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame('24000', $day1Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame('45000', $day1Solution->solveSecondPart(self::TEST_INPUT));
    }
}
