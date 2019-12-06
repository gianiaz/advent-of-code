<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day6;

class ObjectInSpace
{
    /** @var self|null */
    private $orbits;

    /** @var self[] */
    private $orbitants = [];

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
}
