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

    public function moveTo(Distance $distance): void
    {
        $this->x = $distance->getX();
        $this->y = $distance->getY();
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

        $compareHealth = $other->getHealth() <=> $this->getHealth();

        if ($compareHealth !== 0) {
            return $compareHealth;
        }

        return $this->compareByDistanceOnly($other);
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
}
