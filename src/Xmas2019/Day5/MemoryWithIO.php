<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class MemoryWithIO extends Memory
{
    /** @var int */
    private $input;

    /** @var int */
    private $output;

    public function getInput(): int
    {
        return $this->input;
    }

    public function setInput(int $input): void
    {
        $this->input = $input;
    }

    public function getOutput(): int
    {
        return $this->output;
    }

    public function setOutput(int $output): void
    {
        $this->output = $output;
    }
}
