<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day16;

class Valve
{
    /** @var self[] */
    public array $linkedValves;
    public function __construct(
        public readonly string $name,
        public readonly int $flowRate,
    ) {
    }

    public static function cacheKey(self ...$valves): string
    {
        if (count($valves)) {
            return implode(
                '-',
                array_map(fn (self $v) => $v->name, $valves)
            );
        }

        return 'end';
    }

    public function addNeighbourValve(self $neighbour): void
    {
        $this->linkedValves[$neighbour->name] = $neighbour;
    }
}
