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
        $expected = [
            new Asteroid(8, 1),
        ];

        $firstRow = $laser->getAsteroidsDestructionSweep();

        foreach ($expected as $i => $destroyed) {
            $this->assertEquals($destroyed, $firstRow[$i]);
        }
    }
}
