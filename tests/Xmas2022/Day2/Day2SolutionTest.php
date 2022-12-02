<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day2;

use Jean85\AdventOfCode\Xmas2022\Day2\Day2Solution;
use PHPUnit\Framework\TestCase;

class Day2SolutionTest extends TestCase
{
    private const TEST_INPUT = 'A Y
B X
C Z';

    public function test(): void
    {
        $Day2Solution = new Day2Solution();

        $this->assertSame('15', $Day2Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $Day2Solution = new Day2Solution();

        $this->assertSame('12', $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
