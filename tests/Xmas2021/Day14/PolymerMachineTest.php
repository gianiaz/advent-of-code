<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day14;

use Jean85\AdventOfCode\Xmas2021\Day14\PolymerMachine;
use PHPUnit\Framework\TestCase;

class PolymerMachineTest extends TestCase
{
    public function test(): void
    {
        $machine = new PolymerMachine('NNCB', 'CH -> B
HH -> N
CB -> H
NH -> C
HB -> C
HC -> B
HN -> C
NN -> C
BH -> H
NC -> B
NB -> B
BN -> B
BB -> N
BC -> B
CC -> N
CN -> C');

        $this->assertSame('NNCB', $machine->getPolymer());

        $machine->step();

        $this->assertSame('NCNBCHB', $machine->getPolymer());

        $machine->step();

        $this->assertSame('NBCCNBBBCBHCB', $machine->getPolymer());

        $machine->step();

        $this->assertSame('NBBBCNCCNBBNBNBBCHBHHBCHB', $machine->getPolymer());

        $machine->step();

        $this->assertSame('NBBNBNBBCCNBCNCCNBBNBBNBBBNBBNBBCBHCBHHNHCBBCBHCB', $machine->getPolymer());

        $machine->step(); // 5

        $this->assertSame(97, strlen($machine->getPolymer()));

        $machine->step();
        $machine->step();
        $machine->step();
        $machine->step();
        $machine->step(); // 10

        $this->assertSame(3073, strlen($machine->getPolymer()));
        $counts = $machine->getElementCounts();
        $this->assertSame(1749, $counts['B']);
        $this->assertSame(298, $counts['C']);
        $this->assertSame(161, $counts['H']);
        $this->assertSame(865, $counts['N']);
    }
}
