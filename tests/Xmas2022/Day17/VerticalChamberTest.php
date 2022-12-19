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

    public function testGetPatternSize(): void
    {
        $verticalChamber = new VerticalChamber(Day17SolutionTest::TEST_INPUT);

        $patternSize = $verticalChamber->findPatternSize();

        $this->assertSame(53, $verticalChamber->findPatternLength());
        $this->assertSame(25, $verticalChamber->findPatternStartAfter());
        $this->assertSame([16, 35], $patternSize);
    }

    public function testGetPatternSizeWithFullInput(): void
    {
        $fullInput = trim(file_get_contents(dirname(__DIR__, 3) . '/src/Xmas2022/Day17/input.txt'));
        $verticalChamber = new VerticalChamber($fullInput);

        $patternSize = $verticalChamber->findPatternSize();

        $this->assertSame(2796, $verticalChamber->findPatternLength());
        $this->assertSame(138, $verticalChamber->findPatternStartAfter());
        $this->assertSame([91, 1750], $patternSize);
    }
}
