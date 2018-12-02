<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day2;

use Jean85\AdventOfCode\Xmas2018\Day2\Day2Solution;
use PHPUnit\Framework\TestCase;

class Day2SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $solution = new Day2Solution('abcdef bababc abbcde abcccd aabcdd abcdee ababab');

        $this->assertSame(12, $solution->solve());
    }

    public function testSolveSecondPart(): void
    {
        $solution = new Day2Solution('abcde fghij klmno pqrst fguij axcye wvxyz');

        $this->assertSame('fghij' . PHP_EOL . 'fguij', $solution->solveSecondPart());
    }
}
