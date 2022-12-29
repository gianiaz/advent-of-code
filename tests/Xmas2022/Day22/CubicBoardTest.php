<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day22;

use Jean85\AdventOfCode\Xmas2022\Day22\CubicBoard;
use Jean85\AdventOfCode\Xmas2022\Day22\Direction;
use PHPUnit\Framework\TestCase;

class CubicBoardTest extends TestCase
{
    public function testWrapAtoB(): void
    {
        $board = new CubicBoard($this->getReducedInputWithJustOneStepForward(), 4);
        $board->setCurrentPosition(12, 6);
        $board->setCurrentDirection(Direction::Right);
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

        $this->assertSame('        ...#
        .#..
        #...
        ....
...#.......#
........#..>
..#....#....
..........#.
        ...#..v.
        .....#..
        .#......
        ......#.' . PHP_EOL, $board->printMap());
    }

    public function testWrapCtoD(): void
    {
        $board = new CubicBoard($this->getReducedInputWithJustOneStepForward(), 4);
        $board->setCurrentPosition(11, 12);
        $board->setCurrentDirection(Direction::Down);
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

        $this->assertSame('        ...#
        .#..
        #...
        ....
...#.......#
........#...
..#....#....
.^........#.
        ...#....
        .....#..
        .#......
        ..v...#.' . PHP_EOL, $board->printMap());
    }

    public function testWallsBlockAroundEdges(): void
    {
        $board = new CubicBoard($this->getReducedInputWithJustOneStepForward(), 4);
        $board->setCurrentPosition(7, 5);
        $board->setCurrentDirection(Direction::Up);
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

        $this->assertSame('        ...#
        .#..
        #...
        ....
...#..^....#
........#...
..#....#....
..........#.
        ...#....
        .....#..
        .#......
        ......#.' . PHP_EOL, $board->printMap());
    }

    /**
     * @depends testWallsBlockAroundEdges
     */
    public function testWithLimitedInput(): void
    {
        $board = new CubicBoard(Day22SolutionTest::TEST_INPUT, 4);

        $board->executeAllInstructions();

        $this->assertSame('        >>v#
        .#v.
        #.v.
        ..v.
...#..^...v#
.>>>>>^.#.>>
.^#....#....
.^........#.
        ...#..v.
        .....#v.
        .#v<<<<.
        ..v...#.' . PHP_EOL, $board->printMap());
        $this->assertSame(5031, $board->getPassword());
    }

    private function getReducedInputWithJustOneStepForward(): string
    {
        $input = Day22SolutionTest::TEST_INPUT;

        return rtrim(explode(PHP_EOL . PHP_EOL, $input)[0])
            . PHP_EOL
            . PHP_EOL
            . '1'
        ;
    }
}
