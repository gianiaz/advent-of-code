<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day9;

use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\ParameterModes;
use Jean85\AdventOfCode\Xmas2019\Day7\MemoryWithSequentialIO;

class MemoryWithRelativeMode extends MemoryWithSequentialIO
{
    private $relative = 0;

    /** @var int[] */
    private $output = [];

    public function setOutput(int $output): void
    {
        array_unshift($this->output, $output);
    }

    public function getOutput(): int
    {
        return array_pop($this->output);
    }

    public function getAllOutput(): array
    {
        return $this->output;
    }

    public function getRelative(): int
    {
        return $this->relative;
    }

    public function alterRelative(int $diff): void
    {
        $this->relative += $diff;
    }

    public function getAfterPointer(int $ahead, ParameterModes $mode): int
    {
        if ($mode->isRelative($ahead)) {
            $parameter = $this->getMemory()[$this->getPointer() + $ahead];
            $positionToExtractFrom = $this->getMemory()[$this->relative + $parameter] ?? 0;

            return $this->getMemory()[$positionToExtractFrom] ?? 0;
        }

        try {
            return parent::getAfterPointer($ahead, $mode);
        } catch (\Throwable $exception) {
            if (0 === strpos($exception->getMessage(), 'Undefined offset')) {
                return 0;
            }

            throw $exception;
        }
    }
}
