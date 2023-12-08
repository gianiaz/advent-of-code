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

    public static function identityBetween(?Map $prev, ?Map $next): self
    {
        $start = 1 + ($prev?->getSourceEnd() ?? -1)
            ?? throw new \InvalidArgumentException('You need at least one map to handle this case');

        $range = PHP_INT_MAX;
        if ($next) {
            $range = $next->sourceStart - ($prev?->sourceStart ?? 0) - 1;
        }

        return new self($start, $start, $range);
    }

    public function isInRange(int $number): bool
    {
        return $this->sourceStart <= $number
            && $number < ($this->sourceStart + $this->range);
    }

    public function mapValue(int $number): int
    {
        return $this->destinationStart + ($number - $this->sourceStart);
    }

    public function getSourceEnd(): int
    {
        return $this->sourceStart + $this->range - 1;
    }
}
