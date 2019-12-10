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

        $bestVisibility = 0;

        foreach ($map->getAsteroids() as $asteroid) {
            $visibleAsteroidCount = $station->getVisibleAsteroidCount($asteroid->getX(), $asteroid->getY());

            if ($bestVisibility < $visibleAsteroidCount) {
                $bestVisibility = max($bestVisibility, $visibleAsteroidCount);
            }
        }

        return $bestVisibility;
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
