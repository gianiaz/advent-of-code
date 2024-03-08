<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day3;

use Jean85\AdventOfCode\Xmas2022\Day3\Day3Solution;
use PHPUnit\Framework\TestCase;

class Day3SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = '467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..';
        $Day3Solution = new Day3Solution();

        $this->assertSame('4361', $Day3Solution->solve($input));
    }

    public function testSecondPart(): void
    {
        $input = '467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..';
        $Day3Solution = new Day3Solution();

        $this->assertSame('467835', $Day3Solution->solveSecondPart($input));
    }
}
