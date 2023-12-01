<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day11;

use Jean85\AdventOfCode\Xmas2022\Day11\Jungle;
use PHPUnit\Framework\TestCase;

use const true;

class JungleTest extends TestCase
{
    public function testBasicRound(): void
    {
        $jungle = new Jungle(Day11SolutionTest::TEST_INPUT, true);

        $jungle->doRound();

        $this->assertEquals(
            [20, 23, 27, 26],
            $jungle->getMonkey(0)->getItems()
        );
        $this->assertEquals(
            [2080, 25, 167, 207, 401, 1046],
            $jungle->getMonkey(1)->getItems()
        );
        $this->assertEquals(
            [],
            $jungle->getMonkey(2)->getItems()
        );
        $this->assertEquals(
            [],
            $jungle->getMonkey(3)->getItems()
        );
    }
}
