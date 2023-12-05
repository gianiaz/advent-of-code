<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day5;

class Map
{
    public function __construct(
        public readonly int $sourceStart,
        public readonly int $destinationStart,
        public readonly int $range,
    ) {}

    public function isInRange(int $number): bool
    {
        return $this->sourceStart <= $number
            && $number < ($this->sourceStart + $this->range);
    }

    public function mapValue(int $number): int
    {
        return $this->destinationStart + ($number - $this->sourceStart);
    }
}
