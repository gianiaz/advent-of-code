<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day6;

use Jean85\AdventOfCode\Xmas2023\Day6\Race;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public function testGetWinningCombinationsCount(): void
    {
        $race = new Race(7, 9);

        $this->assertSame(4, $race->getWinningCombinationsCount());
    }
}
