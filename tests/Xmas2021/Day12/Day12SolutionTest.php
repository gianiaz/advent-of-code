<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day12;

use Jean85\AdventOfCode\Xmas2021\Day12\Day12Solution;
use PHPUnit\Framework\TestCase;

class Day12SolutionTest extends TestCase
{
    public const TEST_INPUT = 'start-A
start-b
A-c
A-b
b-d
A-end
b-end';

    public function test(): void
    {
        $day12Solution = new Day12Solution();

        $this->assertSame(10, $day12Solution->solve(self::TEST_INPUT));
    }

    public function testBis(): void
    {
        $day12Solution = new Day12Solution();

        $this->assertSame(226, $day12Solution->solve('fs-end
he-DX
fs-he
start-DX
pj-DX
end-zg
zg-sl
zg-pj
pj-he
RW-he
fs-DX
pj-RW
zg-RW
start-pj
he-WI
zg-he
pj-fs
start-RW'));
    }

    public function testSecondPart(): void
    {
        $day12Solution = new Day12Solution();

        $this->assertSame(36, $day12Solution->solveSecondPart(self::TEST_INPUT));
    }
}
