<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

use Jean85\AdventOfCode\SolutionInterface;

class Day10Solution implements SolutionInterface
{
    public function solve(string $input = null)
    {
        $map = new AsteroidMap($input ?? $this->getInput());
        $station = new MonitoringStation($map);

        return $station->calculateBestPosition();
    }

    public function getNthDestroyedAsteroid(MonitoringStation $station, AsteroidMap $map, int $number): Asteroid
    {
        $laser = new RotatingLaser($station, $map->getAsteroids());
        $count = 0;

        while ($sweep = $laser->getAsteroidsDestructionSweep()) {
            foreach ($sweep as $asteroid) {
                if (++$count === $number) {
                    return $asteroid;
                }
            }
        }

        throw new \RuntimeException('Count too high, stopped at ' . $count);
    }

    private function getInput(): string
    {
        return '##.#..#..###.####...######
#..#####...###.###..#.###.
..#.#####....####.#.#...##
.##..#.#....##..##.#.#....
#.####...#.###..#.##.#..#.
..#..#.#######.####...#.##
#...####.#...#.#####..#.#.
.#..#.##.#....########..##
......##.####.#.##....####
.##.#....#####.####.#.####
..#.#.#.#....#....##.#....
....#######..#.##.#.##.###
###.#######.#..#########..
###.#.#..#....#..#.##..##.
#####.#..#.#..###.#.##.###
.#####.#####....#..###...#
##.#.......###.##.#.##....
...#.#.#.###.#.#..##..####
#....#####.##.###...####.#
#.##.#.######.##..#####.##
#.###.##..##.##.#.###..###
#.####..######...#...#####
#..#..########.#.#...#..##
.##..#.####....#..#..#....
.###.##..#####...###.#.#.#
.##..######...###..#####.#
';
    }
}
