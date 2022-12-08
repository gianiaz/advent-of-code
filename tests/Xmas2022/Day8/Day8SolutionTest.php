<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day8;

use Jean85\AdventOfCode\Xmas2022\Day8\Day8Solution;
use PHPUnit\Framework\TestCase;

class Day8SolutionTest extends TestCase
{
    public const TEST_INPUT = '30373
25512
65332
33549
35390';

    public function test(): void
    {
        $solution = new Day8Solution();

        $this->assertSame('21', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day8Solution();

        $this->assertSame('24933642', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
