<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

use const true;

class Rope
{
    public readonly Coordinates $head;
    public readonly Coordinates $tail;
    /** @var array<string, bool> */
    private array $visitedByTail;

    public function __construct()
    {
        $this->head = new Coordinates();
        $this->tail = new Coordinates();
    }

    public function apply(Instruction $instruction): void
    {
        $this->moveTwoKnots($instruction, $this->head, $this->tail, true);
    }

    public function countVisitedByTail(): int
    {
        return count($this->visitedByTail);
    }

    private function markAsVisited(): void
    {
        $this->visitedByTail[$this->tail->__toString()] = true;
    }

    private function moveTwoKnots(Instruction $instruction, Coordinates $head, $tail, bool $markVisited = false): void
    {
        for ($i = 0; $i < $instruction->distance; ++$i) {
            $head->move($instruction->direction);
            if ($tail->isNotAdjacent($head)) {
                $tail->follow($head, $instruction->direction);
            }

            if ($markVisited) {
                $this->markAsVisited();
            }
        }
    }
}
