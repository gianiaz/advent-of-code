<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day10;

use Jean85\AdventOfCode\Xmas2019\Day10\AsteroidMap;
use Jean85\AdventOfCode\Xmas2019\Day10\MonitoringStation;
use PHPUnit\Framework\TestCase;

class MonitoringStationTest extends TestCase
{
    /**
     * @dataProvider firstSolutionProvider
     */
    public function testIsVisibleFromFirstExample(int $x, int $y, bool $isVisible = true): void
    {
        $input = '
.#..#
.....
#####
....#
...##
';

        $map = new AsteroidMap($input);
        $station = new MonitoringStation($map);

        $this->assertSame($isVisible, $station->isVisible(3, 4, $x, $y));
    }

    public function firstSolutionProvider(): array
    {
        return [
            [4, 0],
            [0, 2],
            [1, 2],
            [2, 2],
            [3, 2],
            [4, 2],
            [4, 3],
            [4, 4],
            [1, 0, false],
        ];
    }

    /**
     * @dataProvider inputProvider
     */
    public function testVisibleCount(int $expectedCount, int $x, int $y, string $input): void
    {
        $map = new AsteroidMap($input);
        $station = new MonitoringStation($map);

        $this->assertSame($expectedCount, $station->getVisibleAsteroidCount($x, $y));
    }

    public function inputProvider(): array
    {
        return [
            [
                8,
                3, 4,
                '
.#..#
.....
#####
....#
...##',
            ],
            'this' => [
                33,
                5, 8,
                '
......#.#.
#..#.#....
..#######.
.#.#.###..
.#..#.....
..#....#.#
#..#....#.
.##.#..###
##...#..#.
.#....####',
            ],
            [
                35,
                1, 2,
                '
#.#...#.#.
.###....#.
.#....#...
##.#.#.#.#
....#.#.#.
.##..###.#
..#...##..
..##....##
......#...
.####.###.',
            ],
            [
                41,
                6, 3,
                '
.#..#..###
####.###.#
....###.#.
..###.##.#
##.##.#.#.
....###..#
..#.#..#.#
#..#.#.###
.##...##.#
.....#.#..',
            ],
            [
                210,
                11, 13,
                '
.#..##.###...#######
##.############..##.
.#.######.########.#
.###.#######.####.#.
#####.##.#.##.###.##
..#####..#.#########
####################
#.####....###.#.#.##
##.#################
#####.##.###..####..
..######..##.#######
####.##.####...##..#
.#####..#.######.###
##...#.##########...
#.##########.#######
.####.#.###.###.#.##
....##.##.###..#####
.#.#.###########.###
#.#.#.#####.####.###
###.##.####.##.#..##',
            ],
        ];
    }
}
