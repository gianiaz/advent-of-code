<?php

declare(strict_types=1);

namespace Tests\Xmas2017\Day3;

use Jean85\AdventOfCode\Xmas2017\Day3\GridWithMemory;
use PHPUnit\Framework\TestCase;

class GridWithMemoryTest extends TestCase
{
    /**
     * @dataProvider gridProvider
     */
    public function testCreation(int $upTo, int $expectedResult)
    {
        $grid = new GridWithMemory();

        $this->assertSame($expectedResult, $grid->getGridStepAfter($upTo));
    }

    public function gridProvider()
    {
        yield [1, 2];
        yield [2, 4];
        yield [4, 5];
        yield [5, 10];
        yield [747, 806];
    }
}
