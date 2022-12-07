<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day7;

class File
{
    public function __construct(
        public readonly string $name,
        public readonly int $size,
    ) {
        if ($this->size <= 0) {
            throw new \InvalidArgumentException('Invalid size: ' . $this->size);
        }
    }
}
