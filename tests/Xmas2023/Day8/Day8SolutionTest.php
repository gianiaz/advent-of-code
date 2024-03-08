<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day8;

use Jean85\AdventOfCode\Xmas2022\Day8\Day8Solution;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class Day8SolutionTest extends TestCase
{
    #[DataProvider('part1DataProvider')]
    public function test(string $steps, string $input): void
    {
        $Day8Solution = new Day8Solution();

        $this->assertSame($steps, $Day8Solution->solve($input));
    }

    public static function part1DataProvider()
    {
        return [
            ['2', 'RL

AAA = (BBB, CCC)
BBB = (DDD, EEE)
CCC = (ZZZ, GGG)
DDD = (DDD, DDD)
EEE = (EEE, EEE)
GGG = (GGG, GGG)
ZZZ = (ZZZ, ZZZ)'],
            ['6', 'LLR

AAA = (BBB, BBB)
BBB = (AAA, ZZZ)
ZZZ = (ZZZ, ZZZ)'],
        ];
    }

    public function testSecondPart(): void
    {
        $input = 'LR

11A = (11B, XXX)
11B = (XXX, 11Z)
11Z = (11B, XXX)
22A = (22B, XXX)
22B = (22C, 22C)
22C = (22Z, 22Z)
22Z = (22B, 22B)
XXX = (XXX, XXX)';
        $Day8Solution = new Day8Solution();

        $this->assertSame('6', $Day8Solution->solveSecondPart($input));
    }
}
