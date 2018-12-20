<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\AbstractWarrior;
use Jean85\AdventOfCode\Xmas2018\Day15\DungeonCell;
use Jean85\AdventOfCode\Xmas2018\Day15\Elf;
use Jean85\AdventOfCode\Xmas2018\Day15\Goblin;
use PHPUnit\Framework\TestCase;

class AbstractWarriorTest extends TestCase
{
    public function testCompareTo(): void
    {
        $warrior1 = new Elf(new DungeonCell(0, 0));
        $warrior2 = new Elf(new DungeonCell(0, 0));

        (new Goblin(new DungeonCell(0, 0)))->attack($warrior1);

        $elves = [$warrior1, $warrior2];
        \usort($elves, function (AbstractWarrior $a, AbstractWarrior $b) {
            return $a->compareTo($b);
        });

        $this->assertSame([$warrior1, $warrior2], $elves);
    }
}
