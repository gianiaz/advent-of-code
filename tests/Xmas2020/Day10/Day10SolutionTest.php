<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day10;

use Jean85\AdventOfCode\Xmas2020\Day10\Day10Solution;
use PHPUnit\Framework\TestCase;

class Day10SolutionTest extends TestCase
{
    public function testFirstSolution(): void
    {
        $input = $this->getInput();
        $solution = new Day10Solution();

        $this->assertSame(220, $solution->solve($input));
    }

    public function testSecondSolution(): void
    {
        $input = $this->getInput();
        $solution = new Day10Solution();

        $this->assertSame(8, $solution->solveSecondPart($input));
    }

    private function getInput(): string
    {
        return '28
33
18
42
31
14
46
20
48
47
24
23
49
45
19
38
39
11
1
32
25
35
8
17
7
9
4
2
34
10
3';
    }
}
