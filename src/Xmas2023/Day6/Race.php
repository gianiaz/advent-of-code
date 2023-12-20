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
        return 1 + $this->getLastWinningCombination() - $this->getFirstWinningCombination();
    }

    private function wins(int $holdFor): bool
    {
        $remainingTime = $this->time - $holdFor;

        return $this->distance < $remainingTime * $holdFor;
    }

    public function getFirstWinningCombination(): int
    {
        $start = 0;
        $end = $this->getMiddlePointThatWins();

        do {
            $middle = $this->getMiddle($start, $end);

            if ($middle === $start) {
                return $this->wins($middle)
                    ? $middle
                    : $end;
            }

            if ($this->wins($middle)) {
                $end = $middle;
            } else {
                $start = $middle;
            }
        } while (true);
    }

    public function getLastWinningCombination(): int
    {
        $start = $this->getMiddlePointThatWins();
        $end = $this->distance;

        do {
            $middle = $this->getMiddle($start, $end);

            if ($middle === $start) {
                return $this->wins($end)
                    ? $end
                    : $middle;
            }

            if ($this->wins($middle)) {
                $start = $middle;
            } else {
                $end = $middle;
            }
        } while (true);
    }

    private function getMiddlePointThatWins(): int
    {
        $middle = (int) ceil($this->distance * 0.75);
        while (! $this->wins($middle)) {
            $middle = (int) floor($middle / 2);
        }

        return $middle;
    }

    private function getMiddle(int $start, int $end): int
    {
        return $start + (int) floor(($end - $start) / 2);
    }
}
