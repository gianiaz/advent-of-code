<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day11;

use Jean85\AdventOfCode\Xmas2021\Day11\Day11Solution;
use PHPUnit\Framework\TestCase;

class Day11SolutionTest extends TestCase
{
    public const TEST_INPUT = '5483143223
2745854711
5264556173
6141336146
6357385478
4167524645
2176841721
6882881134
4846848554
5283751526';

    public function test(): void
    {
        $day11Solution = new Day11Solution();

        $this->assertSame(1656, $day11Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day11Solution = new Day11Solution();

        $this->assertSame(195, $day11Solution->solveSecondPart(self::TEST_INPUT));
    }
}
