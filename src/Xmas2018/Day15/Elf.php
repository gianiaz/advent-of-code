<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

class Elf extends AbstractWarrior
{
    /** @var int */
    private $attackPower;

    public function __construct(DungeonCell $cell, int $attackPower = 3)
    {
        parent::__construct($cell);
        $this->attackPower = $attackPower;
    }

    public function attack(AbstractWarrior $tango): void
    {
        $tango->health -= $this->attackPower;
    }

    public static function getSymbol(): string
    {
        return 'E';
    }
}
