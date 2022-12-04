<?php

namespace Jean85\AdventOfCode\Xmas2022\Day4;

class Elf
{
    /**
     * @return array{self, self}
     */
    public static function parse(string $input): array
    {
        [$range1, $range2] = explode(',', $input);

        return [
            new self(...explode('-', $range1)),
            new self(...explode('-', $range2)),
        ];
    }
    
    private function __construct(
        public readonly int $start,
        public readonly int $end,
    ) {
    }

    public function contains(Elf $otherElf): bool
    {
        return $this->start <= $otherElf->start
            && $this->end >= $otherElf->end;
    }

    public function overlapsWith(Elf $otherElf): bool
    {
        return $this->start <= $otherElf->end
            && $this->end >= $otherElf->start;
    }
}
