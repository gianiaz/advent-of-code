<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day8;

use Jean85\AdventOfCode\Xmas2020\Day8\Day8Solution;
use PHPUnit\Framework\TestCase;

class Day8SolutionTest extends TestCase
{
    public function testSecondSolution(): void
    {
        $input = 'nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6';

        $solution = new Day8Solution();

        $this->assertEquals(8, $solution->solveSecondPart($input));
    }
}
