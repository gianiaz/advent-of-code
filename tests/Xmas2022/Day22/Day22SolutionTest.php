<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day22;

use Jean85\AdventOfCode\Xmas2022\Day22\Day22Solution;
use PHPUnit\Framework\TestCase;

class Day22SolutionTest extends TestCase
{
    public const TEST_INPUT = '        ...#
        .#..
        #...
        ....
...#.......#
........#...
..#....#....
..........#.
        ...#....
        .....#..
        .#......
        ......#.

10R5L5R10L4R5L5';

    public function test(): void
    {
        $solution = new Day22Solution();

        $this->assertSame('6032', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $solution = new Day22Solution();

        $this->assertSame('5031', $solution->solveSecondPart(self::TEST_INPUT));
    }

    public function testSecondPartWithFullInput(): void
    {
        $solution = new Day22Solution();

        $this->assertLessThan(163201, (int) $solution->solveSecondPart());
    }
}
