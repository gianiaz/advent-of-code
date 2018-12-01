<?php

namespace Jean85\AdventOfCode\Xmas2017\Day7;

class Tower
{
    /** @var string */
    private $name;

    /** @var int */
    private $weight;

    /** @var string[] */
    private $supports;

    /**
     * Tower constructor.
     * @param string $name
     * @param int $weight
     * @param string[] $supports
     */
    public function __construct(string $name, int $weight, array $supports = [])
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->supports = $supports;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return string[]
     */
    public function getSupports(): array
    {
        return $this->supports;
    }
}
