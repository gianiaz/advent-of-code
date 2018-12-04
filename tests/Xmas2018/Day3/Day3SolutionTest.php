<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day3;

use Jean85\AdventOfCode\Xmas2018\Day3\Claim;
use Jean85\AdventOfCode\Xmas2018\Day3\Day3Solution;
use Jean85\AdventOfCode\Xmas2018\Day3\Fabric;
use PHPUnit\Framework\TestCase;

class Day3SolutionTest extends TestCase
{
    public function testSolve(): void
    {
        $fabric = new Fabric(8, 8);
        $claims = [
            new Claim('1', 1, 3, 4, 4),
            new Claim('2', 3, 1, 4, 4),
            new Claim('3', 5, 5, 2, 2),
        ];
        $solution = new Day3Solution($fabric, $claims);

        $this->assertSame(4, $solution->solve());
    }
}
