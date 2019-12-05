<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day2;

class Memory
{
    /** @var int[] */
    private $memory;

    /** @var int */
    private $pointer = 0;

    /**
     * Memory constructor.
     *
     * @param int[] $memory
     */
    public function __construct(array $memory)
    {
        $this->memory = $memory;
        $this->pointer = 0;
    }

    public function get(int $position): int
    {
        return $this->memory[$position];
    }

    public function getCurrent(): int
    {
        return $this->memory[$this->pointer];
    }

    /**
     * @return int[]
     */
    public function getMemory(): array
    {
        return $this->memory;
    }

    public function getPointer(): int
    {
        return $this->pointer;
    }

    public function increasePointer(): void
    {
        $this->pointer += 4;
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
