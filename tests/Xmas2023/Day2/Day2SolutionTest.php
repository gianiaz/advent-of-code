<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day2;

use Jean85\AdventOfCode\Xmas2023\Day2\Day2Solution;
use PHPUnit\Framework\TestCase;

class Day2SolutionTest extends TestCase
{
    private const TEST_INPUT = 'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green';

    public function test(): void
    {
        $Day2Solution = new Day2Solution();

        $this->assertSame('8', $Day2Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day2Solution = new Day2Solution();

        $this->assertSame('281', $Day2Solution->solveSecondPart($input));
    }
}
