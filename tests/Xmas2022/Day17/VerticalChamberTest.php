<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day17;

use Jean85\AdventOfCode\Xmas2022\Day17\VerticalChamber;
use PHPUnit\Framework\TestCase;

class VerticalChamberTest extends TestCase
{
    public function testRockByRock(): void
    {
        $verticalChamber = new VerticalChamber(Day17SolutionTest::TEST_INPUT);

        $this->assertSame('+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|...#...|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|..#....|
|..#....|
|####...|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|....##.|
|....##.|
|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|.####..|
|....##.|
|....##.|
|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|..#....|
|.###...|
|..#....|
|.####..|
|....##.|
|....##.|
|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|.....#.|
|.....#.|
|..####.|
|.###...|
|..#....|
|.####..|
|....##.|
|....##.|
|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|....#..|
|....#..|
|....##.|
|....##.|
|..####.|
|.###...|
|..#....|
|.####..|
|....##.|
|....##.|
|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());

        $verticalChamber->simulateNextRock();

        $this->assertSame('|....#..|
|....#..|
|....##.|
|##..##.|
|######.|
|.###...|
|..#....|
|.####..|
|....##.|
|....##.|
|....#..|
|..#.#..|
|..#.#..|
|#####..|
|..###..|
|...#...|
|..####.|
+-------+', $verticalChamber->drawMap());
    }
}
