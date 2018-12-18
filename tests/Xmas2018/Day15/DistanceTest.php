<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\Distance;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase
{
    public function testForceRefresh(): void
    {
        $neighbor1 = new Distance(0, 0);
        $neighbor2 = new Distance(0, 0);
        $distance = new Distance(0, 0);
        $distance->addNeighbor($neighbor1);
        $neighbor1->addNeighbor($neighbor2);

        $distance->setCost(1);

        $this->assertSame(1, $distance->getCost());
        $this->assertSame(2, $neighbor1->getCost());
        $this->assertSame(3, $neighbor2->getCost());

        $neighbor2->setCost(1);

        $this->assertSame(1, $distance->getCost());
        $this->assertSame(2, $neighbor1->getCost());
        $this->assertSame(1, $neighbor2->getCost());
    }

    public function testForceRefreshWithSkipped(): void
    {
        $neighbor1 = new Distance(0, 0);
        $neighbor2 = new Distance(0, 0);
        $distance = new Distance(0, 0);
        $distance->addNeighbor($neighbor1);
        $distance->addNeighbor($neighbor2);

        $distance->setCost(1);

        $this->assertSame(1, $distance->getCost());
        $this->assertSame(2, $neighbor1->getCost());
        $this->assertSame(2, $neighbor2->getCost());

        $neighbor2->setCost(1);

        $this->assertSame(1, $distance->getCost());
        $this->assertSame(2, $neighbor1->getCost());
        $this->assertSame(1, $neighbor2->getCost());
    }
}
