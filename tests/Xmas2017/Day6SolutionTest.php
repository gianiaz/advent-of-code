<?php

namespace Tests\Xmas2017;

use Jean85\AdventOfCode\Xmas2017\Day6\Day6Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    public function testExecuteOneReassignment()
    {
        $solution = new Day6Solution([0, 2, 7, 0]);

        $this->assertSame([0, 2, 7, 0], $solution->getBanks());
        $this->assertSame([2, 4, 1, 2], $solution->executeOneReassignment());
        $this->assertSame([3, 1, 2, 3], $solution->executeOneReassignment());
        $this->assertSame([0, 2, 3, 4], $solution->executeOneReassignment());
        $this->assertSame([1, 3, 4, 1], $solution->executeOneReassignment());
        $this->assertSame([2, 4, 1, 2], $solution->executeOneReassignment());
    }

    public function testSolve()
    {
        $solution = new Day6Solution([0, 2, 7, 0]);

        $this->assertSame(5, $solution->solve());
        $this->assertSame([2, 4, 1, 2], $solution->getBanks());
    }

    public function testSolveSecondPart()
    {
        $solution = new Day6Solution([0, 2, 7, 0]);

        $this->assertSame(4, $solution->solveSecondPart());
        $this->assertSame([2, 4, 1, 2], $solution->getBanks());
    }
}
