<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day4;

use Jean85\AdventOfCode\Xmas2018\Day4\AbstractTimestamp;
use Jean85\AdventOfCode\Xmas2018\Day4\BeginShift;
use Jean85\AdventOfCode\Xmas2018\Day4\FallsAsleep;
use Jean85\AdventOfCode\Xmas2018\Day4\TimestampFactory;
use Jean85\AdventOfCode\Xmas2018\Day4\WakesUp;
use PHPUnit\Framework\TestCase;

class TimestampFactoryTest extends TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $string, AbstractTimestamp $expected): void
    {
        $timestamp = TimestampFactory::create($string);

        $this->assertEquals($expected, $timestamp);
    }

    public function createDataProvider()
    {
        return[
            ['[1518-11-01 00:00] Guard #10 begins shift', new BeginShift('1518-11-01 00:00', '10')],
            ['[1518-11-01 00:05] falls asleep', new FallsAsleep('1518-11-01 00:05')],
            ['[1518-11-01 00:25] wakes up', new WakesUp('1518-11-01 00:25')],
        ];
    }

    public function asdasd()
    {
        return[
            '[1518-11-01 00:00] Guard #10 begins shift',
            '[1518-11-01 00:05] falls asleep',
            '[1518-11-01 00:25] wakes up',
            '[1518-11-01 00:30] falls asleep',
            '[1518-11-01 00:55] wakes up',
            '[1518-11-01 23:58] Guard #99 begins shift',
            '[1518-11-02 00:40] falls asleep',
            '[1518-11-02 00:50] wakes up',
            '[1518-11-03 00:05] Guard #10 begins shift',
            '[1518-11-03 00:24] falls asleep',
            '[1518-11-03 00:29] wakes up',
            '[1518-11-04 00:02] Guard #99 begins shift',
            '[1518-11-04 00:36] falls asleep',
            '[1518-11-04 00:46] wakes up',
            '[1518-11-05 00:03] Guard #99 begins shift',
            '[1518-11-05 00:45] falls asleep',
            '[1518-11-05 00:55] wakes up',
        ];
    }
}
