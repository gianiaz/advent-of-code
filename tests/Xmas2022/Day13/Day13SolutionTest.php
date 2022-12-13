<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day13;

use Jean85\AdventOfCode\Xmas2022\Day13\Day13Solution;
use Jean85\AdventOfCode\Xmas2022\Day13\Receiver;
use PHPUnit\Framework\TestCase;

class Day13SolutionTest extends TestCase
{
    public const TEST_INPUT = '[1,1,3,1,1]
[1,1,5,1,1]

[[1],[2,3,4]]
[[1],4]

[9]
[[8,7,6]]

[[4,4],4,4]
[[4,4],4,4,4]

[7,7,7,7]
[7,7,7]

[]
[3]

[[[]]]
[[]]

[1,[2,[3,[4,[5,6,7]]]],8,9]
[1,[2,[3,[4,[5,6,0]]]],8,9]';

    public function test(): void
    {
        $solution = new Day13Solution();

        $this->assertSame('13', $solution->solve(self::TEST_INPUT), Receiver::$debug);
    }

    public function testSecondPart(): void
    {
        self::markTestIncomplete();
        $solution = new Day13Solution();

        $this->assertSame('29', trim($solution->solveSecondPart(self::TEST_INPUT)));
    }
}
