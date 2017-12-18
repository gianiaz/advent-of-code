<?php

namespace Tests;

use Jean85\AdventOfCode\Day2\Day2Solution;
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
}
