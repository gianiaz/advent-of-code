<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day6;

use Jean85\AdventOfCode\Xmas2019\Day6\ObjectInSpace;
use Jean85\AdventOfCode\Xmas2019\Day6\OrbitCounter;
use PHPUnit\Framework\TestCase;

class OrbitCounterTest extends TestCase
{
    public function testCount(): void
    {
        $centerOfMass = $this->createGraph();
        $counter = new OrbitCounter();

        $this->assertSame(42, $counter->count($centerOfMass));
    }

    private function createGraph(): ObjectInSpace
    {
        $centerOfMass = new ObjectInSpace();
        $b = new ObjectInSpace();
        $c = new ObjectInSpace();
        $d = new ObjectInSpace();
        $e = new ObjectInSpace();
        $f = new ObjectInSpace();
        $g = new ObjectInSpace();
        $h = new ObjectInSpace();
        $i = new ObjectInSpace();
        $j = new ObjectInSpace();
        $k = new ObjectInSpace();
        $l = new ObjectInSpace();

        $centerOfMass->addOrbitant($b);
        $b->addOrbitant($g);
        $b->addOrbitant($c);
        $g->addOrbitant($h);
        $c->addOrbitant($d);
        $d->addOrbitant($e);
        $d->addOrbitant($i);
        $e->addOrbitant($f);
        $e->addOrbitant($j);
        $j->addOrbitant($k);
        $k->addOrbitant($l);

        return $centerOfMass;
    }
}
