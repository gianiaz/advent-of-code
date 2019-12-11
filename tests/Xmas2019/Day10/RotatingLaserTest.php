<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day10;

use Jean85\AdventOfCode\Xmas2019\Day10\Asteroid;
use Jean85\AdventOfCode\Xmas2019\Day10\AsteroidMap;
use Jean85\AdventOfCode\Xmas2019\Day10\MonitoringStation;
use Jean85\AdventOfCode\Xmas2019\Day10\RotatingLaser;
use PHPUnit\Framework\TestCase;

class RotatingLaserTest extends TestCase
{
    public function testGetAsteroidsInOrderOfDestruction(): void
    {
        $input = '.#....#####...#..
##...##.#####..##
##...#...#.#####.
..#.....#...###..
..#.#.....#....##';

        $map = new AsteroidMap($input);
        $station = new MonitoringStation($map);
        $laser = new RotatingLaser($station, $map->getAsteroids());

        $this->assertEquals(new Asteroid(8, 3), $station->getBestPosition());
        $expectedSweeps = [
            [
                // first quadrant
                new Asteroid(8, 1),
                new Asteroid(9, 0),
                new Asteroid(9, 1),
                new Asteroid(10, 0),
                new Asteroid(9, 2),
                new Asteroid(11, 1),
                new Asteroid(12, 1),
                new Asteroid(11, 2),
                new Asteroid(15, 1),
                // second quadrant
                new Asteroid(12, 2),
                new Asteroid(13, 2),
                new Asteroid(14, 2),
                new Asteroid(15, 2),
            ],
        ];

        foreach ($expectedSweeps as $sweep) {
            $firstRow = $laser->getAsteroidsDestructionSweep();
            foreach ($sweep as $i => $destroyed) {
                $this->assertEquals($destroyed, $firstRow[$i]);
            }
        }
    }
}
