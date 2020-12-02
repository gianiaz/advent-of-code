<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day2;

class Policy
{
    private string $char;
    private int $min;
    private int $max;

    public function __construct(string $char, int $min, int $max)
    {
        $this->char = $char;
        $this->min = $min;
        $this->max = $max;
    }

    public function getChar(): string
    {
        return $this->char;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }
}
