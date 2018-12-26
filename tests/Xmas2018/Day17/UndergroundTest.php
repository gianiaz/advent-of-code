<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day17;

use Jean85\AdventOfCode\Xmas2018\Day17\ClayInput;
use Jean85\AdventOfCode\Xmas2018\Day17\Underground;
use PHPUnit\Framework\TestCase;

class UndergroundTest extends TestCase
{
    public function testGetActualSituation(): void
    {
        $underground = new Underground(ClayInput::getTestInput());
        $expectedSituation = '......+.......
............#.
.#..#.......#.
.#..#..#......
.#..#..#......
.#.....#......
.#.....#......
.#######......
..............
..............
....#.....#...
....#.....#...
....#.....#...
....#######...
';

        $this->assertSame(
            $expectedSituation,
            $underground->getActualSituation(),
            'Map not matching' . PHP_EOL . $underground->getActualSituation()
        );
    }

    /**
     * @dataProvider flowSituationProvider
     */
    public function testFlow(int $flowCount, string $expectedFinalSituation): void
    {
        $this->markTestSkipped();
        $underground = new Underground(ClayInput::getTestInput());

        while ($flowCount--) {
            $underground->flow();
        }

        $this->assertSame(
            $expectedFinalSituation,
            $underground->getActualSituation(),
            'Map not matching' . PHP_EOL . $underground->getActualSituation()
        );
    }

    public function flowSituationProvider(): array
    {
        return [
            [
                5,
                '......+.......
......|.....#.
.#..#.|.....#.
.#..#.|#......
.#..#.|#......
.#....|#......
.#~~~~~#......
.#######......
..............
..............
....#.....#...
....#.....#...
....#.....#...
....#######...
',
            ],
            'flow right' => [
                10,
                '......+.......
......|.....#.
.#..#.|.....#.
.#..#.|#......
.#..#.|#......
.#~~~~~#......
.#~~~~~#......
.#######......
..............
..............
....#.....#...
....#.....#...
....#.....#...
....#######...
',
            ],
            'no pressure1' => [
                12,
                '......+.......
......|.....#.
.#..#.|.....#.
.#..#.|#......
.#..#~~#......
.#~~~~~#......
.#~~~~~#......
.#######......
..............
..............
....#.....#...
....#.....#...
....#.....#...
....#######...
',
            ],
            'no pressure2' => [
                14,
                '......+.......
......|.....#.
.#..#.|.....#.
.#..#~~#......
.#..#~~#......
.#~~~~~#......
.#~~~~~#......
.#######......
..............
..............
....#.....#...
....#.....#...
....#.....#...
....#######...
',
            ],
            'overflow to the left' => [
                15,
                '......+.......
......|.....#.
.#..#||||...#.
.#..#~~#|.....
.#..#~~#|.....
.#~~~~~#|.....
.#~~~~~#|.....
.#######|.....
........|.....
........|.....
....#...|.#...
....#...|.#...
....#~|||.#...
....#######...
',
            ],
            '16' => [
                16,
                '......+.......
......|.....#.
.#..#||||...#.
.#..#~~#|.....
.#..#~~#|.....
.#~~~~~#|.....
.#~~~~~#|.....
.#######|.....
........|.....
........|.....
....#...|.#...
....#...|.#...
....#~~||.#...
....#######...
',
            ],
            'before filling right' => [
                17,
                '......+.......
......|.....#.
.#..#||||...#.
.#..#~~#|.....
.#..#~~#|.....
.#~~~~~#|.....
.#~~~~~#|.....
.#######|.....
........|.....
........|.....
....#...|.#...
....#...|.#...
....#~~~|.#...
....#######...
',
            ],
            'right sequence' => [
                18,
                '......+.......
......|.....#.
.#..#||||...#.
.#..#~~#|.....
.#..#~~#|.....
.#~~~~~#|.....
.#~~~~~#|.....
.#######|.....
........|.....
........|.....
....#...|.#...
....#...|.#...
....#~~~|~#...
....#######...
',
            ],
            'fill below' => [
                19,
                '......+.......
......|.....#.
.#..#||||...#.
.#..#~~#|.....
.#..#~~#|.....
.#~~~~~#|.....
.#~~~~~#|.....
.#######|.....
........|.....
........|.....
....#...|.#...
....#...|.#...
....#~~~~~#...
....#######...
',
            ],
            'complete below' => [
                29,
                '......+.......
......|.....#.
.#..#||||...#.
.#..#~~#|.....
.#..#~~#|.....
.#~~~~~#|.....
.#~~~~~#|.....
.#######|.....
........|.....
........|.....
....#~~~~~#...
....#~~~~~#...
....#~~~~~#...
....#######...
',
            ],
        ];
    }

    public function testCountWetSpots(): void
    {
        $underground = new Underground(ClayInput::getTestInput());

        $this->assertSame(0, $underground->countWetSpots());

        $underground->flow();

        $this->assertSame(57, $underground->countWetSpots());
    }

    public function testCountRetainedWaterSpots(): void
    {
        $underground = new Underground(ClayInput::getTestInput());

        $this->assertSame(0, $underground->countWetSpots());

        $underground->flow();

        $this->assertSame(29, $underground->countRetainedWaterSpots());
    }
}
