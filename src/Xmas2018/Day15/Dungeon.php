<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Dungeon
{
    private const SPACE = '.';

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

    public function tick(): void
    {
        $warriors = array_merge($this->elves, $this->goblins);
        usort($warriors, function (AbstractWarrior $a, AbstractWarrior $b) {
            return $a->getY() <=> $b->getY()
                ?? $a->getX() <=> $b->getX();
        });

        foreach ($warriors as $warrior) {
            if ($warrior instanceof Elf) {
                $this->moveWarrior($warrior, $this->goblins);
            } else {
                $this->moveWarrior($warrior, $this->elves);
            }
        }
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

    private function moveWarrior(AbstractWarrior $warrior, array $targets): void
    {
        $distanceMap = $this->createEmptyDistanceMap();

        foreach ($targets as $tango) {
            foreach ($this->getAdjacentDistances($distanceMap, $tango->getX(), $tango->getY()) as $target) {
                $target->setCost(0);
            }
        }

        if ($bestMove = $this->getBestMove($warrior, $distanceMap)) {
            $this->map[$warrior->getY()][$warrior->getX()] = self::SPACE;
            $warrior->moveTo($bestMove);
            $this->map[$warrior->getY()][$warrior->getX()] = (string) $warrior;
        }
    }

    /**
     * @return Distance[][]
     */
    private function createEmptyDistanceMap(): array
    {
        /** @var Distance[][] $distanceMap */
        $distanceMap = [];
        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $cell) {
                if (self::SPACE === $this->map[$y][$x]) {
                    $distanceMap[$y][$x] = new Distance($x, $y);
                }
            }
        }

        foreach ($distanceMap as $y => $row) {
            foreach ($row as $x => $distance) {
                foreach ($this->getAdjacentDistances($distanceMap, $x, $y) as $neighbour) {
                    $distance->addNeighbor($neighbour);
                }
            }
        }

        return $distanceMap;
    }

    /**
     * @param Distance[][] $distanceMap
     *
     * @return Distance[]
     */
    private function getAdjacentDistances(array $distanceMap, int $x, int $y): array
    {
        $adjacent = [];
        if ($neighbour = $distanceMap[$y - 1][$x] ?? null) {
            $adjacent[] = $neighbour;
        }
        if ($neighbour = $distanceMap[$y][$x - 1] ?? null) {
            $adjacent[] = $neighbour;
        }
        if ($neighbour = $distanceMap[$y][$x + 1] ?? null) {
            $adjacent[] = $neighbour;
        }
        if ($neighbour = $distanceMap[$y + 1][$x] ?? null) {
            $adjacent[] = $neighbour;
        }

        return $adjacent;
    }

    /**
     * @param Distance[][] $distanceMap
     */
    private function getBestMove(AbstractWarrior $warrior, array $distanceMap): ?Distance
    {
        $possibleMoves = $this->getAdjacentDistances($distanceMap, $warrior->getX(), $warrior->getY());
        usort($possibleMoves, function (Distance $a, Distance $b) {
            return $a->getCost() <=> $b->getCost()
                ?? $a->getY() <=> $b->getY()
                ?? $a->getX() <=> $b->getX();
        });

        return \array_shift($possibleMoves);
    }
}
