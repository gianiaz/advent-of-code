<?php

namespace Jean85\AdventOfCode\Xmas2018\Day22;

class CaveRegion
{
    /** @var int|null */
    private $geologicIndex;
    
    /** @var int|null */
    private $erosionLevel;

    /**
     * @return int|null
     */
    public function getGeologicIndex(): ?int
    {
        return $this->geologicIndex;
    }

    /**
     * @param int|null $geologicIndex
     */
    public function setGeologicIndex(?int $geologicIndex): void
    {
        $this->geologicIndex = $geologicIndex;
    }

    /**
     * @return int|null
     */
    public function getErosionLevel(): ?int
    {
        return $this->erosionLevel;
    }

    /**
     * @param int|null $erosionLevel
     */
    public function setErosionLevel(?int $erosionLevel): void
    {
        $this->erosionLevel = $erosionLevel;
    }
}
