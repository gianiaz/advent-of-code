<?php

namespace Tests\Day3;

use Jean85\AdventOfCode\Day3\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    /**
     * @dataProvider gridProvider
     */
    public function testCreation(int $upTo, int $manhattanDistance)
    {
        $grid = new Grid();

        $this->assertSame($manhattanDistance, $grid->getGridCost($upTo));
    }

    public function gridProvider()
    {
        yield [1, 0];
        yield [12, 3];
        yield [23, 2];
        yield [1024, 31];
    }
}
