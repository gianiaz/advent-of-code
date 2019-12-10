<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day10;

use Jean85\AdventOfCode\Xmas2019\Day10\AsteroidMap;
use PHPUnit\Framework\TestCase;

class AsteroidMapTest extends TestCase
{
    public function testPrintMap(): void
    {
        $input = '.#..#
.....
#####
....#
...##
';

        $map = new AsteroidMap($input);

        $this->assertSame($input, $map->printMap());
    }

    public function testIsAsteroid(): void
    {
        $input = '.#..#
.....
#####
....#
...##';
        $map = new AsteroidMap($input);

        $expectedAsteroids = [
            0 => [1, 4],
            2 => [0, 1, 2, 3, 4],
            3 => [4],
            4 => [3, 4],
        ];

        foreach ($expectedAsteroids as $y => $row) {
            foreach ($row as $x) {
                $this->assertTrue($map->isAsteroid($x, $y), 'Wrong map in ' . $x . ' ' . $y);
            }
        }

        foreach (range(0, 4) as $y) {
            foreach (range(0, 4) as $x) {
                $asteroidIsPresent = in_array($x, $expectedAsteroids[$y] ?? [], true);
                $this->assertSame($asteroidIsPresent, $map->isAsteroid($x, $y), 'Wrong map in ' . $x . ' ' . $y);
            }
        }
    }
}
