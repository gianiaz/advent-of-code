<?php

declare(strict_types=1);

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
     *
     * @param string[] $supports
     */
    public function __construct(string $name, int $weight, array $supports = [])
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->supports = $supports;
    }

    public function getName(): string
    {
        return $this->name;
    }

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
