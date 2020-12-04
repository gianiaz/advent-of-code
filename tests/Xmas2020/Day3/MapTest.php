<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day3;

use Jean85\AdventOfCode\Xmas2020\Day3\Map;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    /**
     * @dataProvider treeCoordinatesDataProvider
     */
    public function testHasTree(int $x, int $y): void
    {
        $map = $this->createMap();

        $this->assertTrue($map->hasTree($x, $y), 'Expected tree missing');
    }

    public function treeCoordinatesDataProvider(): array
    {
        return [
            [3, 1],
            [4, 1],
            [1, 2],
            [2, 3],
            [14, 1],
            [15, 1],
            [22, 8],
            [31, 11],
        ];
    }

    /**
     * @dataProvider openCoordinatesDataProvider
     */
    public function testHasTreeReturnsFalse(int $x, int $y): void
    {
        $map = $this->createMap();

        $this->assertFalse($map->hasTree($x, $y), 'Unexpected tree');
    }

    public function openCoordinatesDataProvider(): array
    {
        return [
            [1, 1],
            [2, 1],
            [2, 2],
            [1, 3],
            [1, 4],
            [13, 1],
            [16, 1],
        ];
    }

    private function createMap(): Map
    {
        $input = '..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#';

        return new Map($input);
    }
}
