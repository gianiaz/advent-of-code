<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day7;

use Jean85\AdventOfCode\Xmas2022\Day7\Day7Solution;
use PHPUnit\Framework\TestCase;

class Day7SolutionTest extends TestCase
{
    public const TEST_INPUT = '$ cd /
$ ls
dir a
14848514 b.txt
8504156 c.dat
dir d
$ cd a
$ ls
dir e
29116 f
2557 g
62596 h.lst
$ cd e
$ ls
584 i
$ cd ..
$ cd ..
$ cd d
$ ls
4060174 j
8033020 d.log
5626152 d.ext
7214296 k';

    public function test(): void
    {
        $solution = new Day7Solution();

        $this->assertSame('95437', $solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $this->markTestIncomplete();
        $solution = new Day7Solution();

        $this->assertSame('MCD', $solution->solveSecondPart(self::TEST_INPUT));
    }
}
