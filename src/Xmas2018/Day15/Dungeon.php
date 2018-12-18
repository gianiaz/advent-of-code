<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Dungeon
{
    /** @var AbstractWarrior[] */
    private $map;

    /** @var Elf[] */
    private $elves = [];

    /** @var Goblin[] */
    private $goblins = [];

    public function __construct(string $map)
    {
        $this->map = $this->initMap($map);
    }

    public function getActualSituation(): string
    {
        $situation = [];

        foreach ($this->map as $row) {
            $situation[] = implode('', $row);
        }

        return implode(PHP_EOL, $situation);
    }

    /**
     * @return Elf[]
     */
    public function getElves(): array
    {
        return $this->elves;
    }

    /**
     * @return Goblin[]
     */
    public function getGoblins(): array
    {
        return $this->goblins;
    }

    private function initMap(string $map): array
    {
        $translatedMap = [];

        foreach (explode(PHP_EOL, $map) as $y => $row) {
            foreach (str_split($row) as $x => $cell) {
                $toBeFilled = $cell;

                switch ($cell) {
                    case Goblin::getSymbol():
                        $toBeFilled = new Goblin($x, $y);
                        $this->goblins[] = $toBeFilled;
                        break;
                    case Elf::getSymbol():
                        $toBeFilled = new Elf($x, $y);
                        $this->elves[] = $toBeFilled;
                        break;
                }

                $translatedMap[$y][$x] = $toBeFilled;
            }
        }

        return $translatedMap;
    }
}
