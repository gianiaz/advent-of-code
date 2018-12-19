<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

abstract class AbstractWarrior extends AbstractPosition
{
    /** @var int */
    private $health = 200;

    public function getHealth(): int
    {
        return $this->health;
    }

    public function isDead(): bool
    {
        return $this->health <= 0;
    }

    public function moveToward(Distance $target): void
    {
        $move = $target->findStepToward();

        $this->x = $move->getX();
        $this->y = $move->getY();
    }

    abstract public static function getSymbol(): string;

    public function __toString()
    {
        return static::getSymbol();
    }

    public function compareTo(AbstractPosition $other): int
    {
        if (! $other instanceof self) {
            throw new \InvalidArgumentException('Not comparable: ' . \get_class($other));
        }

        $compareHealth = $this->getHealth() <=> $other->getHealth();

        if ($compareHealth !== 0) {
            return $compareHealth;
        }

        return $this->compareByReadingOrder($other);
    }

    public function canAttack(AbstractWarrior $tango): bool
    {
        if ($tango instanceof static) {
            return false;
        }

        $manhattanDistance = abs($this->x - $tango->x) + abs($this->y - $tango->y);

        return 1 === $manhattanDistance;
    }

    public function attack(AbstractWarrior $tango): void
    {
        $tango->health -= 3;
    }

    public function getDistanceFrom(AbstractPosition $a): int
    {
        return abs($a->x - $this->x) + abs($a->y - $this->y);
    }
}
