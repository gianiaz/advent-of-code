<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day22;

class CaveRegion
{
    /** @var int|null */
    private $geologicIndex;

    /** @var int|null */
    private $erosionLevel;

    public function getGeologicIndex(): ?int
    {
        return $this->geologicIndex;
    }

    public function setGeologicIndex(?int $geologicIndex): void
    {
        $this->geologicIndex = $geologicIndex;
    }

    public function getErosionLevel(): ?int
    {
        return $this->erosionLevel;
    }

    public function setErosionLevel(?int $erosionLevel): void
    {
        $this->erosionLevel = $erosionLevel;
    }
}
