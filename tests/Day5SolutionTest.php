<?php

namespace Tests;

use Jean85\AdventOfCode\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    public function testSolve()
    {
        $solution = new Day5Solution([0, 3,  0,  1,  -3]);

        $this->assertSame(5, $solution->solve());
    }
}
