<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day12;

use Jean85\AdventOfCode\Xmas2020\Day12\Ship;
use PHPUnit\Framework\TestCase;

class ShipTest extends TestCase
{
    public function testDirection(): void
    {
        $ship = new Ship();

        $this->assertSame(0, $ship->getCurrentDirection());

        $ship->move('R', 360);

        $this->assertSame(0, $ship->getCurrentDirection());

        $ship->move('L', 360);

        $this->assertSame(0, $ship->getCurrentDirection());

        $ship->move('L', 90);

        $this->assertSame(3, $ship->getCurrentDirection());
    }

    public function test(): void
    {
        $ship = new Ship();

        $ship->move('F', 10);

        $this->assertSame(10, $ship->getEast());
        $this->assertSame(0, $ship->getNorth());
        $this->assertSame(0, $ship->getCurrentDirection());

        $ship->move('N', 3);

        $this->assertSame(10, $ship->getEast());
        $this->assertSame(3, $ship->getNorth());

        $ship->move('F', 7);

        $this->assertSame(17, $ship->getEast());
        $this->assertSame(3, $ship->getNorth());

        $ship->move('R', 90);

        $this->assertSame(17, $ship->getEast());
        $this->assertSame(3, $ship->getNorth());
        $this->assertSame(1, $ship->getCurrentDirection());

        $ship->move('F', 11);

        $this->assertSame(17, $ship->getEast());
        $this->assertSame(-8, $ship->getNorth());
        $this->assertSame(1, $ship->getCurrentDirection());
    }
}
