<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day12;

use Jean85\AdventOfCode\Xmas2019\Day12\Coordinates;
use Jean85\AdventOfCode\Xmas2019\Day12\Moon;
use PHPUnit\Framework\TestCase;

class MoonTest extends TestCase
{
    public function testApplyGravity(): void
    {
        $moon1 = new Moon(3, 0, 0);
        $moon2 = new Moon(5, 0, 0);

        $moon1->applyGravity($moon2);

        $this->assertEquals(new Coordinates(1, 0, 0), $moon1->getVelocity());
        $this->assertEquals(new Coordinates(-1, 0, 0), $moon2->getVelocity());
    }

    public function testApplyGravityIsCommutative(): void
    {
        $moon1 = new Moon(3, 0, 0);
        $moon2 = new Moon(5, 0, 0);

        $moon2->applyGravity($moon1);

        $this->assertEquals(new Coordinates(1, 0, 0), $moon1->getVelocity());
        $this->assertEquals(new Coordinates(-1, 0, 0), $moon2->getVelocity());
    }

    public function testApplyGravityWorksOnAllAxys(): void
    {
        $moon1 = new Moon(3, 0, 5);
        $moon2 = new Moon(5, 0, 3);

        $moon2->applyGravity($moon1);

        $this->assertEquals(new Coordinates(1, 0, -1), $moon1->getVelocity());
        $this->assertEquals(new Coordinates(-1, 0, 1), $moon2->getVelocity());
    }

    public function testApplyVelocity(): void
    {
        $moon = new Moon(3, 0, 5);

        $moon->applyVelocity();

        $this->assertEquals(new Coordinates(3, 0, 5), $moon->getPosition());

        $moon->getVelocity()->x = 2;
        $moon->getVelocity()->y = -2;
        $moon->getVelocity()->z = 1;

        $moon->applyVelocity();

        $this->assertEquals(new Coordinates(5, -2, 6), $moon->getPosition());
    }

    public function testGetTotalEnergy(): void
    {
        $moon = new Moon(2, 1, 3);
        $moon->getVelocity()->x = 3;
        $moon->getVelocity()->y = 2;
        $moon->getVelocity()->z = 1;

        $this->assertSame(6, $moon->getPotentialEnergy());
        $this->assertSame(6, $moon->getKineticEnergy());
        $this->assertSame(36, $moon->getTotalEnergy());
    }
}
