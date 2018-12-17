<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day13;

use Jean85\AdventOfCode\Xmas2018\Day13\Day13Solution;
use PHPUnit\Framework\TestCase;

class Day13SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $solution = new Day13Solution($this->getExampleTracks());

        $this->assertSame('7,3', $solution->solve());
    }

    public function testSolveSecondPart(): void
    {
        $start = '/>-<\  
|   |  
| /<+-\
| | | v
\>+</ |
  |   ^
  \<->/';
        $solution = new Day13Solution($start);

        $this->assertSame('6,4', $solution->solveSecondPart());
    }

    private function getExampleTracks(): string
    {
        return
            '/->-\
|   |  /----\
| /-+--+-\  |
| | |  | v  |
\-+-/  \-+--/
  \------/';
    }
}
