<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day2;

use Jean85\AdventOfCode\Xmas2021\Day2\Day2Solution;
use PHPUnit\Framework\TestCase;

class Day2SolutionTest extends TestCase
{
    private const TEST_INPUT = [
        'forward 5',
        'down 5',
        'forward 8',
        'up 3',
        'down 8',
        'forward 2',
    ];

    public function test(): void
    {
        $Day2Solution = new Day2Solution();

        $this->assertSame(150, $Day2Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $Day2Solution = new Day2Solution();

        $this->assertSame(900, $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
