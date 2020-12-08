<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day8;

class Instruction
{
    private string $command;
    private int $argument;

    public function __construct(string $command, int $argument)
    {
        $this->command = $command;
        $this->argument = $argument;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getArgument(): int
    {
        return $this->argument;
    }
}
