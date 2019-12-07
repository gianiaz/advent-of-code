<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day7;

use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;

class MemoryWithSequentialIO extends MemoryWithIO
{
    /** @var int[] */
    private $input = [];

    public function setInput(int $input): void
    {
        array_unshift($this->input, $input);
    }

    public function getInput(): int
    {
        return array_pop($this->input);
    }
}
