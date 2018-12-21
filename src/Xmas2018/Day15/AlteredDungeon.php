<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class AlteredDungeon extends Dungeon
{
    /** @var int */
    private $elfAttackPower;

    public function __construct(string $map, int $elfAttackPower = 3)
    {
        $this->elfAttackPower = $elfAttackPower;
        parent::__construct($map);
    }

    protected function createElf(DungeonCell $dungeonCell): Elf
    {
        return new Elf($dungeonCell, $this->elfAttackPower);
    }

    protected function removeWarrior(AbstractWarrior $tango): void
    {
        if ($tango instanceof Elf) {
            throw new ElfDied('Elf died at turn ' . $this->getTurns() . PHP_EOL . $this->getActualSituation());
        }

        parent::removeWarrior($tango);
    }
}
