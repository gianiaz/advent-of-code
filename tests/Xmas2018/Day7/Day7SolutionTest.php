<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day7;

use Jean85\AdventOfCode\Xmas2018\Day7\Day7Solution;
use PHPUnit\Framework\TestCase;

class Day7SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $solution = new Day7Solution($this->getInput());

        $this->assertSame('CABDFE', $solution->solve());
    }

    private function getInput()
    {
        return [
            ['C', 'A'],
            ['C', 'F'],
            ['A', 'B'],
            ['A', 'D'],
            ['B', 'E'],
            ['D', 'E'],
            ['F', 'E'],
        ];
    }
}
