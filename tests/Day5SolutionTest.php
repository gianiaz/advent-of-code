<?php

namespace Tests;

use Jean85\AdventOfCode\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    public function testSolve()
    {
        $solution = new Day5Solution([0, 3, 0, 1, -3]);

        $this->assertSame(5, $solution->solve());
        $this->assertSame([2, 5, 0, 1, -2], $solution->getInput());
    }

    public function testSolveSecondPart()
    {
        $solution = new Day5Solution([0, 3, 0, 1, -3]);

        $this->assertSame(10, $solution->solveSecondPart());
        $this->assertSame([2, 3, 2, 3, -1], $solution->getInput());
    }

    public function testSolveSecondPartWithTheRealInput()
    {
        $solution = new Day5Solution();

        $this->assertSame(27688760, $solution->solveSecondPart());
    }
}
