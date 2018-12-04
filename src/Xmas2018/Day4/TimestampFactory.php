<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day4;

class TimestampFactory
{
    public static function create(string $string): AbstractTimestamp
    {
        $timestamp = \substr($string, 1, 16);

        switch (\substr($string, 19, 5)) {
            case 'Guard':
                $guardId = \substr($string, 26, -13);

                return new BeginShift($timestamp, $guardId);
            case 'wakes':
                return new WakesUp($timestamp);
            case 'falls':
                return new FallsAsleep($timestamp);
            default:
                throw new \InvalidArgumentException('Unrecognized text: ' . \substr($string, 20, 5));
        }
    }
}
