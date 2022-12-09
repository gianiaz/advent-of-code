<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

class RopeWithMultipleKnots extends Rope
{
    /** @var Coordinates[] */
    private array $intermediateKnots = [];

    public function __construct(int $numberOfKnots)
    {
        parent::__construct();

        $numberOfKnots -= 2;
        do {
            $this->intermediateKnots[] = new Coordinates();
        } while (--$numberOfKnots);
    }

    public function apply(Instruction $instruction): void
    {
        for ($i = 0; $i < $instruction->distance; ++$i) {
            $head = $this->head;
            $head->move($instruction->direction);

            foreach ($this->intermediateKnots as $knot) {
                $knot->follow($head);
                $head = $knot;
            }

            $this->tail->follow($head);
            $this->markAsVisited();
        }
    }

    public function getKnot(int $number): Coordinates
    {
        if ($number === 0) {
            return $this->head;
        }

        if ($number === count($this->intermediateKnots) + 1) {
            return $this->tail;
        }

        return $this->intermediateKnots[$number - 1]
            ?? throw new \InvalidArgumentException('Knot not found: ' . $number);
    }
}
