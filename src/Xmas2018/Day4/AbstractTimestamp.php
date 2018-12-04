<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day4;

abstract class AbstractTimestamp
{
    /** @var \DateTimeImmutable */
    private $time;

    public function __construct(string $time)
    {
        $this->time = new \DateTimeImmutable($time);
    }

    public function getTime(): \DateTimeImmutable
    {
        return $this->time;
    }

    public function getMinutes(): int
    {
        return (int) $this->time->format('i');
    }

    public function getTimeString(): string
    {
        return $this->time->format('Y-m-d H:i');
    }
}
