<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day21;

use Jean85\AdventOfCode\Xmas2022\Day21\Day21Solution;
use PHPUnit\Framework\TestCase;

class Day21SolutionTest extends TestCase
{
    public const TEST_INPUT = 'root: pppw + sjmn
dbpl: 5
cczh: sllz + lgvd
zczc: 2
ptdq: humn - dvpt
dvpt: 3
lfqf: 4
humn: 5
ljgn: 2
sjmn: drzm * dbpl
sllz: 4
pppw: cczh / lfqf
lgvd: ljgn * ptdq
drzm: hmdt - zczc
hmdt: 32';

    public function test(): void
    {
        $solution = new Day21Solution();

        $this->assertSame('152', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $solution = new Day21Solution();

        $this->assertSame('301', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
