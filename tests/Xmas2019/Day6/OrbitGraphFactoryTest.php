<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day6;

use Jean85\AdventOfCode\Xmas2019\Day6\OrbitCounter;
use Jean85\AdventOfCode\Xmas2019\Day6\OrbitGraphFactory;
use PHPUnit\Framework\TestCase;

class OrbitGraphFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $input =
'COM)B
B)C
C)D
D)E
E)F
B)G
G)H
D)I
E)J
J)K
K)L';
        $graph = OrbitGraphFactory::create($input);
        $counter = new OrbitCounter();

        $this->assertSame(42, $counter->count($graph));
    }
}
