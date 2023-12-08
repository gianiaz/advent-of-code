<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day5;

class Interval
{
    public function __construct(
        public readonly string $type,
        public readonly int $start,
        public readonly int $end,
    ) {}

    public function getRange(): int
    {
        return $this->end - $this->start;
    }

    /**
     * @return self[]
     */
    public function splitAccordingTo(AlmanacEntry $almanacEntry): array
    {
        if ($this->isShorterThan($almanacEntry)) {
            return [$this];
        }
    }

    private function isShorterThan(AlmanacEntry $almanacEntry): bool
    {
        return $this->end <= $almanacEntry->to;
    }
}
