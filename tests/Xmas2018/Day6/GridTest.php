<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day6;

use Jean85\AdventOfCode\Xmas2018\Day6\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testToString(): void
    {
        $grid = new Grid(10, 10);
        $expected = str_repeat(str_repeat('.', 10) . PHP_EOL, 10);

        $this->assertSame($expected, $grid->__toString());
    }

    public function testSet(): void
    {
        $grid = new Grid(10, 10);
        $points = [
            'A' => [1, 1],
            'B' => [1, 6],
            'C' => [8, 3],
            'D' => [3, 4],
            'E' => [5, 5],
            'F' => [8, 9],
        ];
        $expected =
'..........
.A........
..........
........C.
...D......
.....E....
.B........
..........
..........
........F.' . PHP_EOL;

        foreach ($points as $name => $point) {
            $grid->set($name, $point[0], $point[1]);
        }

        $this->assertSame($expected, $grid->__toString());
    }
}
