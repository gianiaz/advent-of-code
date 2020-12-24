<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day11;

use Jean85\AdventOfCode\Xmas2020\Day11\SeatMapV1;
use PHPUnit\Framework\TestCase;

class SeatMapV1Test extends TestCase
{
    public function testPrint(): void
    {
        $seatMap = SeatMapV1::init($this->getInput());

        $this->assertSame($this->getInput(), $seatMap->print());
    }

    public function testTick(): void
    {
        $seatMap = SeatMapV1::init($this->getInput());

        $this->assertSame($this->getInput(), $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.LL.L#.##
#LLLLLL.L#
L.L.L..L..
#LLL.LL.L#
#.LL.LL.LL
#.LLLL#.##
..L.L.....
#LLLLLLLL#
#.LLLLLL.L
#.#LLLL.##', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.##.L#.##
#L###LL.L#
L.#.#..#..
#L##.##.L#
#.##.LL.LL
#.###L#.##
..#.#.....
#L######L#
#.LL###L.L
#.#L###.##', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.#L.L#.##
#LLL#LL.L#
L.L.L..#..
#LLL.##.L#
#.LL.LL.LL
#.LL#L#.##
..L.L.....
#L#LLLL#L#
#.LLLLLL.L
#.#L#L#.##', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.#L.L#.##
#LLL#LL.L#
L.#.L..#..
#L##.##.L#
#.#L.LL.LL
#.#L#L#.##
..L.L.....
#L#L##L#L#
#.LLLLLL.L
#.#L#L#.##', $seatMap->print());
        $this->assertFalse($seatMap->tick());
        $this->assertSame('#.#L.L#.##
#LLL#LL.L#
L.#.L..#..
#L##.##.L#
#.#L.LL.LL
#.#L#L#.##
..L.L.....
#L#L##L#L#
#.LLLLLL.L
#.#L#L#.##', $seatMap->print());
        $this->assertFalse($seatMap->tick());
        $this->assertSame('#.#L.L#.##
#LLL#LL.L#
L.#.L..#..
#L##.##.L#
#.#L.LL.LL
#.#L#L#.##
..L.L.....
#L#L##L#L#
#.LLLLLL.L
#.#L#L#.##', $seatMap->print());
        $this->assertSame(37, $seatMap->countOccupiedSeats());
    }

    private function getInput(): string
    {
        return 'L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL';
    }
}
