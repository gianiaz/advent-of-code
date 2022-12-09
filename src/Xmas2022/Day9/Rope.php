<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

class Rope
{
    public readonly Coordinates $head;
    public readonly Coordinates $tail;

    public function __construct()
    {
        $this->head = new Coordinates();
        $this->tail = new Coordinates();
    }

    public function apply(Instruction $instruction): void
    {
        for ($i = 0; $i < $instruction->distance; ++$i) {
            $this->head->move($instruction->direction);
            if ($this->tail->isAdjacent($this->head)) {
                continue;
            }

            $this->tail->follow($this->head, $instruction->direction);
        }
    }
}
