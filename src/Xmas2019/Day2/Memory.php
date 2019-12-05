<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2;

class Memory
{
    /** @var int[] */
    private $memory;

    /**
     * Memory constructor.
     *
     * @param int[] $memory
     */
    public function __construct(array $memory)
    {
        $this->memory = $memory;
    }

    public function get(int $position): int
    {
        return $this->memory[$position];
    }

    /**
     * @return int[]
     */
    public function getMemory(): array
    {
        return $this->memory;
    }

    public function getAsValue(int $position): int
    {
        throw new \RuntimeException('Incomplete');
        $positionToExtractFrom = $this->memory[$position];

        return $this->memory[$positionToExtractFrom];
    }

    public function getFromPosition(int $position): int
    {
        $positionToExtractFrom = $this->memory[$position];

        return $this->memory[$positionToExtractFrom];
    }

    public function set(int $position, int $value): void
    {
        $this->memory[$position] = $value;
    }
}
