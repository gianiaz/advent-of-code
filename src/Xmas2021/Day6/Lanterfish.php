<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day6;

class Lanterfish
{
    private int $counter;

    public function __construct(int $counter = 8)
    {
        $this->counter = $counter;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function tick(): ?self
    {
        if ($this->counter === 0) {
            $this->counter = 6;

            return new self();
        }

        --$this->counter;

        return null;
    }
}
