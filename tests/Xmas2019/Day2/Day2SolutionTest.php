<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day2;

use Jean85\AdventOfCode\Xmas2019\Day2\Day2Solution;
use Jean85\AdventOfCode\Xmas2019\Day2\Memory;
use PHPUnit\Framework\TestCase;

class Day2SolutionTest extends TestCase
{
    /**
     * @dataProvider stepDataProvider
     */
    public function testComputer(array $before, array $after): void
    {
        $solution = new Day2Solution();
        $memory = new Memory($before);

        $solution->run($memory);

        $this->assertEquals($after, $memory->getMemory());
    }

    public function stepDataProvider(): array
    {
        return [
            [
                [1, 0, 0, 0, 99],
                [2, 0, 0, 0, 99],
            ],
            [
                [2, 3, 0, 3, 99],
                [2, 3, 0, 6, 99],
            ],
            [
                [2, 4, 4, 5, 99, 0],
                [2, 4, 4, 5, 99, 9801],
            ],
            [
                [1, 1, 1, 4, 99, 5, 6, 0, 99],
                [30, 1, 1, 4, 2, 5, 6, 0, 99],
            ],
            [
                [1,    9, 10, 3,  2, 3, 11, 0, 99, 30, 40, 50],
                [3500, 9, 10, 70, 2, 3, 11, 0, 99, 30, 40, 50],
            ],
        ];
    }
}
