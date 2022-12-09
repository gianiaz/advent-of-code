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
        for ($i = 0; $i < $instruction->distance; ++$i) {
            $this->head->move($instruction->direction);
            $this->tail->follow($this->head);
            $this->markAsVisited();
        }
    }

    public function countVisitedByTail(): int
    {
        return count($this->visitedByTail);
    }

    protected function markAsVisited(): void
    {
        $this->visitedByTail[$this->tail->__toString()] = true;
    }
}
