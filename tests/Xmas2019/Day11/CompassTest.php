<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day11;

use Jean85\AdventOfCode\Xmas2019\Day11\Compass;
use Jean85\AdventOfCode\Xmas2019\Day11\Direction;
use PHPUnit\Framework\TestCase;

class CompassTest extends TestCase
{
    public function testNextDirections(): void
    {
        $compass = new Compass();

        $this->assertEquals(Direction::left(), $compass->nextDirection(0));
        $this->assertEquals(Direction::down(), $compass->nextDirection(0));
        $this->assertEquals(Direction::right(), $compass->nextDirection(0));
        $this->assertEquals(Direction::up(), $compass->nextDirection(0));
        $this->assertEquals(Direction::right(), $compass->nextDirection(1));
        $this->assertEquals(Direction::up(), $compass->nextDirection(0));
        $this->assertEquals(Direction::left(), $compass->nextDirection(0));
    }
}
