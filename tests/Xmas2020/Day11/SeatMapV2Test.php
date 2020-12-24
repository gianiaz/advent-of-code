<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day11;

use Jean85\AdventOfCode\Xmas2020\Day11\SeatMapV2;
use PHPUnit\Framework\TestCase;

class SeatMapV2Test extends TestCase
{
    public function testTick(): void
    {
        $input = 'L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL';
        $seatMap = SeatMapV2::init($input);

        $this->assertSame($input, $seatMap->print());
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
        $this->assertSame('#.LL.LL.L#
#LLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLL#
#.LLLLLL.L
#.LLLLL.L#', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.L#.##.L#
#L#####.LL
L.#.#..#..
##L#.##.##
#.##.#L.##
#.#####.#L
..#.#.....
LLL####LL#
#.L#####.L
#.L####.L#', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##LL.LL.L#
L.LL.LL.L#
#.LLLLL.LL
..L.L.....
LLLLLLLLL#
#.LLLLL#.L
#.L#LL#.L#', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.#L.L#
#.L####.LL
..#.#.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#', $seatMap->print());
        $this->assertTrue($seatMap->tick());
        $this->assertSame('#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.LL.L#
#.LLLL#.LL
..#.L.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#', $seatMap->print());
        $this->assertFalse($seatMap->tick());
        $this->assertSame('#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.LL.L#
#.LLLL#.LL
..#.L.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#', $seatMap->print());
        $this->assertSame(26, $seatMap->countOccupiedSeats());
    }
}
