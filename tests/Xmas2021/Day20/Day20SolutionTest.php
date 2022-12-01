<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day20;

use Jean85\AdventOfCode\Xmas2021\Day20\Day20Solution;
use PHPUnit\Framework\TestCase;

class Day20SolutionTest extends TestCase
{
    public function test(): void
    {
        $day20Solution = new Day20Solution();

        $this->assertEquals(35, $day20Solution->solve($this->getTestInput()));
    }

    public function testSecondPart(): void
    {
        $day20Solution = new Day20Solution();

        $this->markTestIncomplete();
        $this->assertEquals(3993, $day20Solution->solveSecondPart($this->getTestInput()));
    }

    private function getTestInput(): string
    {
        return '..#.#..#####.#.#.#.###.##.....###.##.#..###.####..#####..#....#..#..##..###..######.###...####..#..#####..##..#.#####...##.#.#..#.##..#.#......#.###.######.###.####...#.##.##..#..#..#####.....#.#....###..#.##......#.....#..#..#..##..#...##.######.####.####.#.#...#.......#..#.#.#...####.##.#......#..#...##.#.##..#...##.#.##..###.#......#.#.......#.#.#.####.###.##...#.....####.#..#..#.##.#....##..#.####....##...##..#...#......#.#.......#.......##..####..#...#.#.#...##..#.#..###..#####........#..####......#..#

#..#.
#....
##..#
..#..
..###';
    }
}
