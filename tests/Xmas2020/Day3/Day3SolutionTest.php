<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day3;

use Jean85\AdventOfCode\Xmas2020\Day3\Day3Solution;
use PHPUnit\Framework\TestCase;

class Day3SolutionTest extends TestCase
{
    public function test(): void
    {
        $solution = new Day3Solution();
        $input = '..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#
';

        $this->assertSame(7, $solution->solve($input));
    }
}
