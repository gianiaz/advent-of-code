<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day7;

use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;

class MemoryWithYieldedIO extends MemoryWithIO
{
    /** @var \Generator<int> */
    private $inputGenerator;

    /** @var \Generator<int> */
    private $outputGenerator;

    /** @var int */
    private $lastOutput;

    public function setInput(int $input): void
    {
        if ($this->inputGenerator === null) {
            $this->inputGenerator = $this->generateInput($input);
        } else {
            $this->inputGenerator->send($input);
        }
    }

    public function getInput(): int
    {
        $this->inputGenerator->next();

        return $this->inputGenerator->current();
    }

    /**
     * @return \Generator<int>
     */
    public function getInputGenerator(): \Generator
    {
        return $this->inputGenerator;
    }

    public function setOutput(int $output): void
    {
        if ($this->outputGenerator === null) {
            $this->outputGenerator = $this->generateOutput($output);
        } else {
            $this->outputGenerator->send($output);
        }

        $this->lastOutput = $output;
    }

    public function getOutput(): int
    {
        $this->outputGenerator->next();

        return $this->outputGenerator->current();
    }

    public function setOutputGenerator(\Generator $outputGenerator): void
    {
        $this->outputGenerator = $outputGenerator;
    }

    private function generateInput(int $initValue): \Generator
    {
        yield from [$initValue];
    }

    private function generateOutput(int $initValue): \Generator
    {
        yield from [$initValue];
    }
}
