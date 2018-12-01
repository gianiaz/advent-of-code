<?php

namespace Tests\Xmas2017;

use Jean85\AdventOfCode\Xmas2017\Day2\Day2Solution;
use PHPUnit\Framework\TestCase;

class Day2SolutionTest extends TestCase
{
    public function testSolution()
    {
        $input = [
            [5, 1, 9, 5],
            [7, 5, 3],
            [2, 4, 6, 8],
        ];
        $solution = new Day2Solution($input);

        $this->assertSame([8, 4, 6], $solution->getRowDifferences());
        $this->assertSame(18, $solution->solve());
    }

    public function testPartTwo()
    {
        $input = [
            [5, 9, 2, 8],
            [9, 4, 7, 3],
            [3, 8, 6, 5],
        ];
        $solution = new Day2Solution($input);

        $this->assertSame([4, 3, 2], $solution->getRowDifferencesPartTwo());
        $this->assertSame(9, $solution->solveSecondPart());
    }
}
