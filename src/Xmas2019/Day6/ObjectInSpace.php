<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day6;

class ObjectInSpace
{
    /** @var string */
    private $name;

    /** @var self|null */
    private $orbits;

    /** @var self[] */
    private $orbitants = [];

    /** @var bool */
    private $visited = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isSanta(): bool
    {
        return $this->name === 'SAN';
    }

    public function getOrbits(): ?ObjectInSpace
    {
        return $this->orbits;
    }

    /**
     * @return ObjectInSpace[]
     */
    public function getOrbitants(): array
    {
        return $this->orbitants;
    }

    public function addOrbitant(self $orbitant): void
    {
        $this->orbitants[] = $orbitant;
        $orbitant->orbits = $this;
    }

    public function isVisited(): bool
    {
        return $this->visited;
    }

    public function setVisited(): void
    {
        $this->visited = true;
    }
}
