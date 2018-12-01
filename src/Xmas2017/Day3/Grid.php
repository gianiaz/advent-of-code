<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2017\Day3;

class Grid
{
    private $value;
    private $upTo;

    /** @var int */
    private $x = 0;

    /** @var int */
    private $y = 0;

    public function getGridCost(int $upTo): int
    {
        $this->buildGridUpTo($upTo);

        return abs($this->x) + abs($this->y) - 1;
    }

    private function buildGridUpTo(int $upTo): void
    {
        $this->upTo = $upTo;
        $this->value = 1;
        $increment = 1;

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

    private function incrementValue(): void
    {
        if ($this->upTo === $this->value) {
            throw new \RuntimeException();
        }

        ++$this->value;
    }
}
