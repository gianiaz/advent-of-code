<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day6;

use Jean85\AdventOfCode\Xmas2020\Day6\Day6Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = 'abc

a
b
c

ab
ac

a
a
a
a

b';

        $solution = new Day6Solution();
        $this->assertEquals(11, $solution->solve($input));
        $this->assertEquals(6, $solution->solveSecondPart($input));
    }
}
