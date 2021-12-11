<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day11;

use Jean85\AdventOfCode\Xmas2021\Day11\OctopusMap;
use PHPUnit\Framework\TestCase;

class OctopusMapTest extends TestCase
{
    public function testConstructionAndGetter(): void
    {
        $octopusMap = new OctopusMap(Day11SolutionTest::TEST_INPUT);

        $this->assertSame(Day11SolutionTest::TEST_INPUT, $octopusMap->getMapAsString());
    }
}
