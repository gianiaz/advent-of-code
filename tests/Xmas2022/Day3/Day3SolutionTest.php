<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day3;

use Jean85\AdventOfCode\Xmas2022\Day3\Day3Solution;
use PHPUnit\Framework\TestCase;

class Day3SolutionTest extends TestCase
{
    private const TEST_INPUT = 'vJrwpWtwJgWrhcsFMMfFFhFp
jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
PmmdzqPrVvPwwTWBwg
wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
ttgJtRGJQctTZtZT
CrZsJsPPZsGzwwsLwLmpwMDw';

    public function test(): void
    {
        $Day2Solution = new Day3Solution();

        $this->assertSame('157', $Day2Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day2Solution = new Day3Solution();

        $this->assertSame('12', $Day2Solution->solveSecondPart(self::TEST_INPUT));
    }
}
