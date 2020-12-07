<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day7;

class Rule
{
    private string $color;
    private string $mayContain;
    private int $count;

    public function __construct(string $color, string $mayContain, int $count)
    {
        $this->color = $color;
        $this->mayContain = $mayContain;
        $this->count = $count;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getMayContain(): string
    {
        return $this->mayContain;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
