<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

use function foo\func;

class Dungeon
{
    public const SPACE = '.';
    public const WALL = '#';

    /** @var int */
    private $turns;

    /** @var DungeonWall[][] */
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
        /** @var AbstractWarrior[] $warriors */
        $warriors = array_merge($this->elves, $this->goblins);
        \usort($warriors, function (AbstractWarrior $a, AbstractWarrior $b) {
            return $a->compareByReadingOrder($b);
        });

        foreach ($warriors as $warrior) {
            if ($warrior->isDead()) {
                continue;
            }

            if ($warrior instanceof Elf) {
                $targets = $this->goblins;
            } else {
                $targets = $this->elves;
            }

            if (\count($targets) === 0) {
                return false;
            }

            $this->moveWarrior($warrior, $targets);
            $this->attack($warrior, $targets);
        }

        ++$this->turns;

        return true;
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
        /** @var DungeonWall[][] $translatedMap */
        $translatedMap = [];

        foreach (explode(PHP_EOL, $map) as $y => $row) {
            foreach (str_split($row) as $x => $char) {
                $dungeonCell = new DungeonCell($x, $y);

                switch ($char) {
                    case self::WALL:
                        $dungeonCell = new DungeonWall($x, $y);
                        break;
                    case Goblin::getSymbol():
                        $warrior = new Goblin($dungeonCell);
                        $this->goblins[] = $warrior;
                        break;
                    case Elf::getSymbol():
                        $warrior = new Elf($dungeonCell);
                        $this->elves[] = $warrior;
                        break;
                    case self::SPACE:
                        break;
                    default:
                        throw new \InvalidArgumentException('Unecognized dungeon symbol: ' . $char);
                }

                $translatedMap[$y][$x] = $dungeonCell;
            }
        }

        foreach ($translatedMap as $y => $row) {
            foreach ($row as $x => $cell) {
                if ($cell instanceof DungeonCell) {
                    foreach ($this->getAdjacentCells($translatedMap, $x, $y) as $adjacentCell) {
                        $cell->addNeighbor($adjacentCell);
                    }
                }
            }

        }

        return $translatedMap;
    }

    /**
     * @param DungeonWall[][] $map
     * @param int $x
     * @param int $y
     * @return DungeonCell[]
     */
    private function getAdjacentCells(array $map, int $x, int $y): array
    {
        $adjacent = [];
        if ($neighbour = $map[$y - 1][$x] ?? null) {
            $adjacent[] = $neighbour;
        }
        if ($neighbour = $map[$y][$x - 1] ?? null) {
            $adjacent[] = $neighbour;
        }
        if ($neighbour = $map[$y][$x + 1] ?? null) {
            $adjacent[] = $neighbour;
        }
        if ($neighbour = $map[$y + 1][$x] ?? null) {
            $adjacent[] = $neighbour;
        }

        return \array_filter($adjacent, function ($a) {
            return $a instanceof DungeonCell;
        });
    }

    /**
     * @param AbstractWarrior[] $targets
     */
    private function moveWarrior(AbstractWarrior $warrior, array $targets): bool
    {
        if ($this->getBestTarget($warrior, $targets)) {
            // can attack, doesn't move
            return true;
        }

        $this->resetMap();
        /** @var DungeonCell[] $nextCellsToBeEvaluated */
        $nextCellsToBeEvaluated = [$warrior->getCell()];
        $seenCells = $nextCellsToBeEvaluated;
        /** @var DungeonCell[] $targets */
        $targets = [];
        do {
            $cellsToBeEvaluated = $nextCellsToBeEvaluated;
            $nextCellsToBeEvaluated = [];
            foreach ($cellsToBeEvaluated as $cell) {
                $neighbors = $cell->getNeighbors();
                foreach ($neighbors as $neighborCell) {
                    $neighborCell->setPrevious($cell);

                    if ($neighborCell->getWarrior()) {
                        $targets[] = $cell;
                    } elseif (! \in_array($neighborCell, $seenCells, true)) {
                        $seenCells[] = $neighborCell;
                        $nextCellsToBeEvaluated[] = $neighborCell;
                    }
                }
            }
        } while ($targets === []);

        \usort($targets, function (DungeonCell $a, DungeonCell $b) {
            return $a->compareTo($b);
        });
        $chosenTarget = $targets[0];

        while (null !== $chosenTarget->getPrevious() && $warrior->getCell() !== $chosenTarget->getPrevious()) {
            $chosenTarget = $chosenTarget->getPrevious();
        }

        $warrior->setCell($chosenTarget);

        return true;
    }

    private function attack(AbstractWarrior $warrior): bool
    {
        if ($tango = $this->getBestTarget($warrior)) {
            $warrior->attack($tango);

            if ($tango->isDead()) {
                $this->removeWarrior($tango);
            }

            return true;
        }

        return false;
    }

    private function getBestTarget(AbstractWarrior $warrior): ?AbstractWarrior
    {
        $possibleTargets = [];
        foreach ($this->getAdjacentCells($this->map, $warrior->getX(), $warrior->getY()) as $adjacentCell) {
            if ($adjacentCell->getWarrior()) {
                $possibleTargets[] = $adjacentCell->getWarrior();
            }
        }

        $targetsInRange = \array_filter($possibleTargets, function(AbstractWarrior $a) use ($warrior) { return $warrior->canAttack($a); });

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

    private function resetMap(): void
    {
        foreach ($this->map as $row) {
            foreach ($row as $cell) {
                if ($cell instanceof DungeonCell) {
                    $cell->setPrevious(null);
                }
            }
        }
    }
}
