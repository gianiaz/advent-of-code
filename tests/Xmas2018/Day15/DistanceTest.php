<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\AbstractPosition;
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

    public function testCompareTo(): void
    {
        $distance1 = new Distance(1, 4);
        $distance2 = new Distance(4, 1);

        $sort = [$distance1, $distance2];

        usort($sort, function (AbstractPosition $a, AbstractPosition $b) {
            return $a->compareTo($b);
        });

        $this->assertSame($distance2, $sort[0]);
        $this->assertSame($distance1, $sort[1]);
    }

    public function testCompareToWith3Elements(): void
    {
        $distance1 = new Distance(1, 4);
        $distance2 = new Distance(4, 1);
        $distance3 = new Distance(4, 4);

        $sort = [$distance1, $distance2, $distance3];

        usort($sort, function (AbstractPosition $a, AbstractPosition $b) {
            return $a->compareTo($b);
        });

        $this->assertSame($distance2, $sort[0]);
        $this->assertSame($distance1, $sort[1]);
        $this->assertSame($distance3, $sort[2]);
    }
}
