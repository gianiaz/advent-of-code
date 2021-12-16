<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day16;

use Jean85\AdventOfCode\Xmas2021\Day16\Day16Solution;
use PHPUnit\Framework\TestCase;

class Day16SolutionTest extends TestCase
{
    public function test(): void
    {
        $day16Solution = new Day16Solution();

        $this->markTestIncomplete();
        $this->assertSame(40, $day16Solution->solve(self::TEST_INPUT));
    }
}
