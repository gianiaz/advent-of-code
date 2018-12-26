<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day18;

use Jean85\AdventOfCode\Xmas2018\Day18\LumberCollectionArea;
use PHPUnit\Framework\TestCase;

class LumberCollectionAreaTest extends TestCase
{
    public function testGetActualSituation(): void
    {
        $lumber = new LumberCollectionArea($this->getTestInput());

        $this->assertSame($this->getTestInput(), $lumber->getActualSituation());
    }

    public function testTick(): void
    {
        $lumber = new LumberCollectionArea($this->getTestInput());

        $this->assertSame($this->getTestInput(), $lumber->getActualSituation());

        $lumber->tick();

        $expectedSituation = '.......##.
......|###
.|..|...#.
..|#||...#
..##||.|#|
...#||||..
||...|||..
|||||.||.|
||||||||||
....||..|.';
        $this->assertSame($expectedSituation, $lumber->getActualSituation());

        $lumber->tick();

        $expectedSituation = '.......#..
......|#..
.|.|||....
..##|||..#
..###|||#|
...#|||||.
|||||||||.
||||||||||
||||||||||
.|||||||||';
        $this->assertSame($expectedSituation, $lumber->getActualSituation());
    }

    public function testGetResourceValue(): void
    {
        $lumber = new LumberCollectionArea($this->getTestInput());
        $count = 10;

        do {
            $lumber->tick();
        } while (--$count);

        $expectedSituation = '.||##.....
||###.....
||##......
|##.....##
|##.....##
|##....##|
||##.####|
||#####|||
||||#|||||
||||||||||';
        $this->assertSame($expectedSituation, $lumber->getActualSituation());
        $this->assertSame(1147, $lumber->getResourceValue());
    }

    private function getTestInput(): string
    {
        return '.#.#...|#.
.....#|##|
.|..|...#.
..|#.....#
#.#|||#|#|
...#.||...
.|....|...
||...#|.#|
|.||||..|.
...#.|..|.';
    }
}
