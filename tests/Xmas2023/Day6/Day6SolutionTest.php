<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day6;

use Jean85\AdventOfCode\Xmas2022\Day6\Day6Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    public function test(): void
    {
        $Day6Solution = new Day6Solution();

        $this->assertSame('288', $Day6Solution->solve($this->getInput()));
    }

    public function testSecondPart(): void
    {
        $Day6Solution = new Day6Solution();

        $this->assertSame('71503', $Day6Solution->solveSecondPart($this->getInput()));
    }

    private function getInput(): string
    {
        return 'Time:      7  15   30
Distance:  9  40  200
';
    }
}
