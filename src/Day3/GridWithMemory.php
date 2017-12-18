<?php

namespace Jean85\AdventOfCode\Day3;

class GridWithMemory
{
    private $value;
    private $upTo;

    /** @var int */
    private $x = 0;

    /** @var int */
    private $y = 0;

    /** @var int[][] */
    private $grid = [];

    public function getGridStepAfter(int $value)
    {
        $this->buildGridUpTo($value);

        return $this->value;
    }

    private function buildGridUpTo(int $upTo): void
    {
        $this->upTo = $upTo;
        $this->value = 1;
        $increment = 1;
        $this->grid[$this->x][$this->y] = 1;

        try {
            do {
                for ($i = 0; $i < $increment; ++$i) {
                    $this->doStepRight();
                }

                for ($i = 0; $i < $increment; ++$i) {
                    $this->doStepUp();
                }

                ++$increment;

                for ($i = 0; $i < $increment; ++$i) {
                    $this->doStepLeft();
                }

                for ($i = 0; $i < $increment; ++$i) {
                    $this->doStepDown();
                }

                ++$increment;
            } while (true);
        } catch (\RuntimeException $exception) {
            return;
        }
    }

    protected function incrementValue(): void
    {
        $this->value =
            $this->getWithCoordsMods(-1, 1) + $this->getWithCoordsMods(0, 1) + $this->getWithCoordsMods(1, 1) +
            $this->getWithCoordsMods(-1, 0) + +$this->getWithCoordsMods(1, 0) +
            $this->getWithCoordsMods(-1, -1) + $this->getWithCoordsMods(0, -1) + $this->getWithCoordsMods(1, -1);

        if ($this->value > $this->upTo) {
            throw new \RuntimeException();
        }

        $this->grid[$this->x][$this->y] = $this->value;
    }

    private function getWithCoordsMods(int $modX, int $modY): int
    {
        return $this->grid[$this->x + $modX][$this->y + $modY] ?? 0;
    }

    private function doStepRight(): void
    {
        ++$this->x;
        $this->incrementValue();
    }

    private function doStepUp(): void
    {
        ++$this->y;
        $this->incrementValue();
    }

    private function doStepLeft(): void
    {
        --$this->x;
        $this->incrementValue();
    }

    private function doStepDown(): void
    {
        --$this->y;
        $this->incrementValue();
    }
}
