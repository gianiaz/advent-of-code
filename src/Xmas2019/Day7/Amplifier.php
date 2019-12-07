<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day7;

use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;

class Amplifier
{
    /** @var IntcodeComputer */
    private $computer;

    /** @var MemoryWithSequentialIO */
    private $memory;

    public function __construct(IntcodeComputer $computer, MemoryWithSequentialIO $memory)
    {
        $this->computer = $computer;
        $this->memory = $memory;
    }

    public function getComputer(): IntcodeComputer
    {
        return $this->computer;
    }

    public function getMemory(): MemoryWithSequentialIO
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
