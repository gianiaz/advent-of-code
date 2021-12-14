<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day14;

use Jean85\AdventOfCode\Xmas2021\Day14\Day14Solution;
use PHPUnit\Framework\TestCase;

class Day14SolutionTest extends TestCase
{
    public const TEST_INPUT = 'NNCB

CH -> B
HH -> N
CB -> H
NH -> C
HB -> C
HC -> B
HN -> C
NN -> C
BH -> H
NC -> B
NB -> B
BN -> B
BB -> N
BC -> B
CC -> N
CN -> C';

    public function test(): void
    {
        $day14Solution = new Day14Solution();

        $this->assertSame(1588, $day14Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day14Solution = new Day14Solution();

        $this->markTestIncomplete();
    }
}
