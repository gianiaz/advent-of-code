<?php

namespace Tests;

use Jean85\AdventOfCode\Day7\Day7Solution;
use Jean85\AdventOfCode\Day7\Tower;
use PHPUnit\Framework\TestCase;

class Day7SolutionTest extends TestCase
{
    public function testSolve()
    {
        $solution = new Day7Solution($this->getTestInput());

        $this->assertSame('tknk', $solution->solve());
    }

    private function getTestInput()
    {
        return [
            new Tower('pbga', 66, []),
            new Tower('xhth', 57, []),
            new Tower('ebii', 61, []),
            new Tower('havc', 66, []),
            new Tower('ktlj', 57, []),
            new Tower('fwft', 72, ['ktlj', 'cntj', 'xhth']),
            new Tower('qoyq', 66, []),
            new Tower('padx', 45, ['pbga', 'havc', 'qoyq']),
            new Tower('tknk', 41, ['ugml', 'padx', 'fwft']),
            new Tower('jptl', 61, []),
            new Tower('ugml', 68, ['gyxo', 'ebii', 'jptl']),
            new Tower('gyxo', 61, []),
            new Tower('cntj', 57, []),
        ];
    }
}
