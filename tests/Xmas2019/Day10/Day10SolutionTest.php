<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day10;

use Jean85\AdventOfCode\Xmas2019\Day10\Asteroid;
use Jean85\AdventOfCode\Xmas2019\Day10\AsteroidMap;
use Jean85\AdventOfCode\Xmas2019\Day10\Day10Solution;
use Jean85\AdventOfCode\Xmas2019\Day10\MonitoringStation;
use PHPUnit\Framework\TestCase;

class Day10SolutionTest extends TestCase
{
    /**
     * @dataProvider destroyedProvider
     */
    public function testGetNthDestroyedAsteroid(int $number, Asteroid $expected): void
    {
        $input = '
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
###.##.####.##.#..##';

        $solution = new Day10Solution();
        $map = new AsteroidMap($input);
        $station = new MonitoringStation($map);

        $this->assertEquals($expected, $solution->getNthDestroyedAsteroid($station, $map, $number));
    }

    public function destroyedProvider(): array
    {
        return [
            [1, new Asteroid(11, 12)],
            [2, new Asteroid(12, 1)],
            [3, new Asteroid(12, 2)],
            [10, new Asteroid(12, 8)],
            [20, new Asteroid(16, 0)],
            [50, new Asteroid(16, 9)],
            [100, new Asteroid(10, 16)],
            [199, new Asteroid(9, 6)],
            [200, new Asteroid(8, 2)],
            [201, new Asteroid(10, 9)],
            [299, new Asteroid(11, 1)],
        ];
    }
}
