<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day5;

use Jean85\AdventOfCode\Xmas2022\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    public function test(): void
    {
        $Day5Solution = new Day5Solution();

        $this->assertSame('35', $Day5Solution->solve($this->getInput()));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $Day5Solution = new Day5Solution();

        $this->assertSame('46', $Day5Solution->solveSecondPart($this->getInput()));
    }

    private function getInput(): string
    {
        return 'seeds: 79 14 55 13

seed-to-soil map:
50 98 2
52 50 48

soil-to-fertilizer map:
0 15 37
37 52 2
39 0 15

fertilizer-to-water map:
49 53 8
0 11 42
42 0 7
57 7 4

water-to-light map:
88 18 7
18 25 70

light-to-temperature map:
45 77 23
81 45 19
68 64 13

temperature-to-humidity map:
0 69 1
1 0 69

humidity-to-location map:
60 56 37
56 93 4';
    }
}
