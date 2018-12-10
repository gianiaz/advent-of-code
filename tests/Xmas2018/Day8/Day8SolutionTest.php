<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day8;

use Jean85\AdventOfCode\Xmas2018\Day8\Day8Solution;
use PHPUnit\Framework\TestCase;

class Day8SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $solution = new Day8Solution('2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2');

        $this->assertSame(138, $solution->solve());
    }
}
