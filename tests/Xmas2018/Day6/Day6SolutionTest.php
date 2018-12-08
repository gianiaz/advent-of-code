<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day6;

use Jean85\AdventOfCode\Xmas2018\Day6\Day6Solution;
use Jean85\AdventOfCode\Xmas2018\Day6\Point;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $input = [
            new Point(1, 1),
            new Point(1, 6),
            new Point(8, 3),
            new Point(3, 4),
            new Point(5, 5),
            new Point(8, 9),
        ];
        $solution = new Day6Solution($input);

        $this->assertSame(17, $solution->solve());
    }
}
