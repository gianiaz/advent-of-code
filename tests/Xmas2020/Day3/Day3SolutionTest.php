<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day3;

use Jean85\AdventOfCode\Xmas2020\Day3\Day3Solution;
use PHPUnit\Framework\TestCase;

class Day3SolutionTest extends TestCase
{
    public function testFirstSolution(): void
    {
        $solution = new Day3Solution();
        $input = $this->getTestInput();

        $this->assertSame(7, $solution->solve($input));
    }

    public function testSecondSolution(): void
    {
        $solution = new Day3Solution();
        $input = $this->getTestInput();

        $this->assertSame(336, $solution->solveSecondPart($input));
    }

    private function getTestInput(): string
    {
        return '..##.......
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
    }
}
