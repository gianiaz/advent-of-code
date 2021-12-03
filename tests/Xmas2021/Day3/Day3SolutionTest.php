<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day3;

use Jean85\AdventOfCode\Xmas2021\Day3\Day3Solution;
use PHPUnit\Framework\TestCase;

class Day3SolutionTest extends TestCase
{
    private const TEST_INPUT = [
        '00100',
        '11110',
        '10110',
        '10111',
        '10101',
        '01111',
        '00111',
        '11100',
        '10000',
        '11001',
        '00010',
        '01010',
    ];

    public function test(): void
    {
        $day3Solution = new Day3Solution();

        $this->assertSame(198, $day3Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day3Solution = new Day3Solution();
        $this->markTestIncomplete();

        $this->assertSame(900, $day3Solution->solveSecondPart(self::TEST_INPUT));
    }
}
