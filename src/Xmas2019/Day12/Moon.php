<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day12;

class Moon
{
    /** @var Coordinates */
    private $position;

    /** @var Coordinates */
    private $velocity;

    public function __construct(int $x, int $y, int $z)
    {
        $this->position = new Coordinates($x, $y, $z);
        $this->velocity = new Coordinates(0, 0, 0);
    }

    public function getPosition(): Coordinates
    {
        return $this->position;
    }

    public function getVelocity(): Coordinates
    {
        return $this->velocity;
    }

    public function applyGravity(Moon $moon2): void
    {
        $axys = ['x', 'y', 'z'];

        foreach ($axys as $a) {
            if ($this->position->$a < $moon2->position->$a) {
                ++$this->velocity->$a;
                --$moon2->velocity->$a;
            }

            if ($this->position->$a > $moon2->position->$a) {
                --$this->velocity->$a;
                ++$moon2->velocity->$a;
            }
        }
    }

    public function applyVelocity(): void
    {
        $this->position->x += $this->velocity->x;
        $this->position->y += $this->velocity->y;
        $this->position->z += $this->velocity->z;
    }

    public function getPotentialEnergy(): int
    {
        return abs($this->position->x)
            + abs($this->position->y)
            + abs($this->position->z)
        ;
    }

    public function getKineticEnergy(): int
    {
        return abs($this->velocity->x)
            + abs($this->velocity->y)
            + abs($this->velocity->z)
        ;
    }

    public function getTotalEnergy(): int
    {
        return $this->getPotentialEnergy() * $this->getKineticEnergy();
    }
}
