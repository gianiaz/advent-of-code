<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day4;

use Jean85\AdventOfCode\Xmas2018\Day4\Day4Solution;
use PHPUnit\Framework\TestCase;

class Day4SolutionTest extends TestCase
{
    /**
     * @dataProvider inputDataProvider
     */
    public function testGetGuardIdThatSleptMostMinutes(string $input): void
    {
        $solution = new Day4Solution($input);

        $this->assertSame(10, $solution->getGuardIdThatSleptMostMinutes());
    }

    /**
     * @dataProvider inputDataProvider
     */
    public function testFindMostSleptMinuteByGuard(string $input): void
    {
        $solution = new Day4Solution($input);

        $this->assertSame(24, $solution->findMostSleptMinuteByGuard(10));
    }

    /**
     * @dataProvider inputDataProvider
     */
    public function testSolve(string $input): void
    {
        $solution = new Day4Solution($input);

        $this->assertSame(240, $solution->solve());
    }

    /**
     * @dataProvider inputDataProvider
     */
    public function testSolveSecondPart(string $input): void
    {
        $solution = new Day4Solution($input);

        $this->assertSame(4455, $solution->solveSecondPart());
    }

    public function inputDataProvider()
    {
        return [[
            '[1518-11-01 00:00] Guard #10 begins shift
[1518-11-01 00:05] falls asleep
[1518-11-01 00:25] wakes up
[1518-11-01 00:30] falls asleep
[1518-11-01 00:55] wakes up
[1518-11-01 23:58] Guard #99 begins shift
[1518-11-02 00:40] falls asleep
[1518-11-02 00:50] wakes up
[1518-11-03 00:05] Guard #10 begins shift
[1518-11-03 00:24] falls asleep
[1518-11-03 00:29] wakes up
[1518-11-04 00:02] Guard #99 begins shift
[1518-11-04 00:36] falls asleep
[1518-11-04 00:46] wakes up
[1518-11-05 00:03] Guard #99 begins shift
[1518-11-05 00:45] falls asleep
[1518-11-05 00:55] wakes up', ],
        ['[1518-11-01 00:00] Guard #10 begins shift
[1518-11-01 00:30] falls asleep
[1518-11-01 00:05] falls asleep
[1518-11-03 00:05] Guard #10 begins shift
[1518-11-01 23:58] Guard #99 begins shift
[1518-11-02 00:40] falls asleep
[1518-11-01 00:25] wakes up
[1518-11-05 00:45] falls asleep
[1518-11-03 00:24] falls asleep
[1518-11-04 00:36] falls asleep
[1518-11-02 00:50] wakes up
[1518-11-04 00:02] Guard #99 begins shift
[1518-11-03 00:29] wakes up
[1518-11-04 00:46] wakes up
[1518-11-05 00:03] Guard #99 begins shift
[1518-11-01 00:55] wakes up
[1518-11-05 00:55] wakes up'],
        ];
    }
}
