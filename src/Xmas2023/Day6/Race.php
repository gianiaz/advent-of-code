<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day6;

class Race
{
    public function __construct(
        public readonly int $time,
        public readonly int $distance,
    ) {}

    public function getWinningCombinationsCount(): int
    {
        $wins = 0;
        $holdFor = 0;

        while (++$holdFor < $this->distance) {
            $remainingTime = $this->time - $holdFor;
            if ($this->distance < $remainingTime * $holdFor) {
                ++$wins;
            }
        }

        return $wins;
    }
}
