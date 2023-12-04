<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day4;

use Jean85\AdventOfCode\Xmas2023\Day4\Day4Solution;
use PHPUnit\Framework\TestCase;

class Day4SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = 'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53
Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19
Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1
Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83
Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36
Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11';
        $Day4Solution = new Day4Solution();

        $this->assertSame('13', $Day4Solution->solve($input));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $input = 'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green';
        $Day4Solution = new Day4Solution();

        $this->assertSame('2286', $Day4Solution->solveSecondPart($input));
    }
}
