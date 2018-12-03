<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day3;

use Jean85\AdventOfCode\Xmas2018\Day3\Claim;
use Jean85\AdventOfCode\Xmas2018\Day3\Fabric;
use PHPUnit\Framework\TestCase;

class FabricTest extends TestCase
{
    public function testAddClaim(): void
    {
        $fabric = new Fabric(11, 9);
        $claim = new Claim('123', 3, 2, 5, 4);

        $fabric->addClaim($claim);

        foreach (range(0, 10) as $left) {
            foreach ([0, 1, 6, 7, 8] as $top) {
                $this->assertSame(0, $fabric->getSquareInch($left, 1)->getClaimCount());
            }
        }

        foreach (range(2, 5) as $top) {
            foreach ([0, 1, 2, 8, 9, 10] as $left) {
                $this->assertSame(0, $fabric->getSquareInch($left, $top)->getClaimCount(), $top . $left . $fabric->toStringArray());
            }
            foreach (range(3, 7) as $left) {
                $this->assertSame(1, $fabric->getSquareInch($left, $top)->getClaimCount(), $top . $left . $fabric->toStringArray());
            }
        }
    }
}
