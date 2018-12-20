<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class DungeonCell extends DungeonWall
{
    /** @var DungeonCell[] */
    private $neighbors = [];

    /** @var self|null */
    private $previous;

    /** @var AbstractWarrior|null */
    private $warrior;

    public function getPrevious(): ?DungeonCell
    {
        return $this->previous;
    }

    public function setPrevious(?DungeonCell $previous): void
    {
        $this->previous = $previous;
    }

    public function getWarrior(): ?AbstractWarrior
    {
        return $this->warrior;
    }

    public function setWarrior(?AbstractWarrior $warrior): void
    {
        $this->warrior = $warrior;
    }

    /**
     * @return DungeonCell[]
     */
    public function getNeighbors(): array
    {
        return $this->neighbors;
    }

    public function addNeighbor(self $new): void
    {
        $this->neighbors[] = $new;
    }

    public function __toString()
    {
        if ($this->warrior) {
            return $this->warrior->__toString();
        }

        return Dungeon::SPACE;
    }
}
