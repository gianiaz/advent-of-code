<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day16;

use Jean85\AdventOfCode\Xmas2018\Day16\Day16Solution;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Opcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Sample;
use PHPUnit\Framework\TestCase;

class Day16SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $sample = new Sample([3, 2, 1, 1], new Opcode(9, 2, 1, 2), [3, 2, 2, 1]);
        $solution = new Day16Solution([$sample]);

        $this->assertSame(1, $solution->solve());
    }
}
