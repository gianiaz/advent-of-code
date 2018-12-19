<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Dungeon
{
    private const SPACE = '.';

    /** @var int */
    private $turns;

    /** @var AbstractWarrior[] */
    private $map;

    /** @var Elf[] */
    private $elves = [];

    /** @var Goblin[] */
    private $goblins = [];

    public function __construct(string $map)
    {
        $this->map = $this->initMap($map);
        $this->turns = 0;
    }

    public function tick(): bool
    {
        $warriors = array_merge($this->elves, $this->goblins);
        \usort($warriors, function (AbstractWarrior $a, AbstractWarrior $b) {
            return $a->compareByDistanceOnly($b);
        });

        $turnWasComplete = false;

        foreach ($warriors as $warrior) {
            if ($warrior instanceof Elf) {
                $targets = $this->goblins;
            } else {
                $targets = $this->elves;
            }

            $turnWasComplete = $this->moveWarrior($warrior, $targets);
            $this->attack($warrior, $targets);
        }

        if ($turnWasComplete) {
            ++$this->turns;
        }

        return $turnWasComplete;
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

    public function getTurns(): int
    {
        return $this->turns;
    }

    public function getOutcome(): int
    {
        return $this->getTotalHealth() * $this->getTurns();
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

    private function moveWarrior(AbstractWarrior $warrior, array $targets): bool
    {
        if ($this->getBestTarget($warrior, $targets)) {
            // can attack, doesn't move
            return true;
        }

        $distanceMap = $this->createEmptyDistanceMap();

        $targetFound = false;
        foreach ($targets as $tango) {
            foreach ($this->getSortedAdjacentPositions($distanceMap, $tango->getX(), $tango->getY()) as $target) {
                $target->setCost(0);
                $targetFound = true;
            }
        }

        if (! $targetFound) {
            return false;
        }

        if ($bestMove = $this->getBestMove($warrior, $distanceMap)) {
            $this->map[$warrior->getY()][$warrior->getX()] = self::SPACE;
            $warrior->moveTo($bestMove);
            $this->map[$warrior->getY()][$warrior->getX()] = (string) $warrior;
        }

        return true;
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
                foreach ($this->getSortedAdjacentPositions($distanceMap, $x, $y) as $neighbour) {
                    $distance->addNeighbor($neighbour);
                }
            }
        }

        return $distanceMap;
    }

    /**
     * @param AbstractPosition[][] $distanceMap
     *
     * @return AbstractPosition[]
     */
    private function getSortedAdjacentPositions(array $distanceMap, int $x, int $y): array
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

        \usort($adjacent, function (AbstractPosition $a, AbstractPosition $b) {
            return $a->compareTo($b);
        });

        return $adjacent;
    }

    /**
     * @param Distance[][] $distanceMap
     */
    private function getBestMove(AbstractWarrior $warrior, array $distanceMap): ?Distance
    {
        $possibleMoves = $this->getSortedAdjacentPositions($distanceMap, $warrior->getX(), $warrior->getY());
        $possibleMoves = \array_filter($possibleMoves, function (Distance $distance) {
            return $distance->getCost() < 1000;
        });

        return \array_shift($possibleMoves);
    }

    private function attack(AbstractWarrior $warrior, array $targets): void
    {
        if ($tango = $this->getBestTarget($warrior, $targets)) {
            $warrior->attack($tango);

            if ($tango->isDead()) {
                $this->removeWarrior($tango);
            }
        }
    }

    private function getBestTarget(AbstractWarrior $warrior, array $targets): ?AbstractWarrior
    {
        $targetsInRange = \array_filter($targets, function (AbstractWarrior $tango) use ($warrior) {
            return $warrior->canAttack($tango);
        });

        \usort($targetsInRange, function (AbstractWarrior $a, AbstractWarrior $b) {
            return $a->compareTo($b);
        });

        return \array_shift($targetsInRange);
    }

    private function removeWarrior(AbstractWarrior $tango): void
    {
        $this->map[$tango->getY()][$tango->getX()] = self::SPACE;

        switch (true) {
            case $tango instanceof Goblin:
                unset($this->goblins[\array_search($tango, $this->goblins, true)]);

                return;
            case $tango instanceof Elf:
                unset($this->elves[\array_search($tango, $this->elves, true)]);

                return;
            default:
                throw new \InvalidArgumentException('Unrecognized warrior: ' . \get_class($tango));
        }
    }

    public function getTotalHealth(): int
    {
        $totalHitPoints = 0;

        foreach ($this->goblins as $goblin) {
            $totalHitPoints += $goblin->getHealth();
        }

        foreach ($this->elves as $elf) {
            $totalHitPoints += $elf->getHealth();
        }

        return $totalHitPoints;
    }
}
