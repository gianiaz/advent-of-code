<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\Day15Solution;
use PHPUnit\Framework\TestCase;

class Day15SolutionTest extends TestCase
{
    /**
     * @dataProvider solveDataProvider
     */
    public function testSolve(string $input, int $outcome): void
    {
        $this->markTestSkipped();
        $solution = new Day15Solution($input);

        $this->assertSame($outcome, $solution->solve());
    }

    public function solveDataProvider()
    {
        return [
            [
                '#######
#.G...#
#...EG#
#.#.#G#
#..G#E#
#.....#
#######',
                27730,
            ],
            [
                '#######
#G..#E#
#E#E.E#
#G.##.#
#...#E#
#...E.#
#######',
                36334,
            ],
        ];
    }
}
