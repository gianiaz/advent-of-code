<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\AbstractPosition;
use Jean85\AdventOfCode\Xmas2018\Day15\DungeonCell;
use PHPUnit\Framework\TestCase;

class DungeonCellTest extends TestCase
{
    public function testCompareTo(): void
    {
        $distance1 = new DungeonCell(1, 4);
        $distance2 = new DungeonCell(4, 1);

        $sort = [$distance1, $distance2];

        usort($sort, function (AbstractPosition $a, AbstractPosition $b) {
            return $a->compareTo($b);
        });

        $this->assertSame($distance2, $sort[0]);
        $this->assertSame($distance1, $sort[1]);
    }

    public function testCompareToWith3Elements(): void
    {
        $distance1 = new DungeonCell(1, 4);
        $distance2 = new DungeonCell(4, 1);
        $distance3 = new DungeonCell(4, 4);

        $sort = [$distance1, $distance2, $distance3];

        usort($sort, function (AbstractPosition $a, AbstractPosition $b) {
            return $a->compareTo($b);
        });

        $this->assertSame($distance2, $sort[0]);
        $this->assertSame($distance1, $sort[1]);
        $this->assertSame($distance3, $sort[2]);
    }
}
