<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day22;

use Jean85\AdventOfCode\Xmas2022\Day22\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function test(): void
    {
        $board = new Board(rtrim(Day22SolutionTest::TEST_INPUT));

        $this->assertSame('        ...#
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
        ......#.' . PHP_EOL, $board->printMap());

        $board->executeAllInstructions();

        $this->assertSame('        >>v#
        .#v.
        #.v.
        ..v.
...#...v..v#
>>>v...>#.>>
..#v...#....
...>>>>v..#.
        ...#....
        .....#..
        .#......
        ......#.' . PHP_EOL, $board->printMap());
    }
}
