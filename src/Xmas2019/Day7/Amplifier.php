<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day7;

use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;
use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;

class Amplifier
{
    /** @var IntcodeComputer */
    private $computer;

    /** @var MemoryWithIO */
    private $memory;

    public function __construct(IntcodeComputer $computer, MemoryWithIO $memory)
    {
        $this->computer = $computer;
        $this->memory = $memory;
    }

    public function getComputer(): IntcodeComputer
    {
        return $this->computer;
    }

    public function getMemory(): MemoryWithIO
    {
        return $this->memory;
    }

    public function execute(int $initValue, int $input): int
    {
        $this->memory->setInput($initValue);
        $this->memory->setInput($input);

        $this->computer->run($this->memory);

        return $this->memory->getOutput();
    }
}
