<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day16;

use Jean85\AdventOfCode\Xmas2022\Day16\Day16Solution;
use PHPUnit\Framework\TestCase;

class Day16SolutionTest extends TestCase
{
    public const TEST_INPUT = 'Valve AA has flow rate=0; tunnels lead to valves DD, II, BB
Valve BB has flow rate=13; tunnels lead to valves CC, AA
Valve CC has flow rate=2; tunnels lead to valves DD, BB
Valve DD has flow rate=20; tunnels lead to valves CC, AA, EE
Valve EE has flow rate=3; tunnels lead to valves FF, DD
Valve FF has flow rate=0; tunnels lead to valves EE, GG
Valve GG has flow rate=0; tunnels lead to valves FF, HH
Valve HH has flow rate=22; tunnel leads to valve GG
Valve II has flow rate=0; tunnels lead to valves AA, JJ
Valve JJ has flow rate=21; tunnel leads to valve II';

    public function test(): void
    {
        $solution = new Day16Solution();

        $this->assertSame('1651', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day16Solution();

        $this->assertSame('1651', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
