<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day11;

use Jean85\AdventOfCode\Xmas2023\Day11\Day11Solution;
use PHPUnit\Framework\TestCase;

class Day11SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = '...#......
.......#..
#.........
..........
......#...
.#........
.........#
..........
.......#..
#...#.....';
        $Day11Solution = new Day11Solution();

        $this->assertSame('374', $Day11Solution->solve($input));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $input = 'LR

11A = (11B, XXX)
11B = (XXX, 11Z)
11Z = (11B, XXX)
22A = (22B, XXX)
22B = (22C, 22C)
22C = (22Z, 22Z)
22Z = (22B, 22B)
XXX = (XXX, XXX)';
        $Day11Solution = new Day11Solution();

        $this->assertSame('6', $Day11Solution->solveSecondPart($input));
    }
}
