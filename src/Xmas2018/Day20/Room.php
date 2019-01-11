<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day20;

class Room
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var self|null */
    private $nord;

    /** @var self|null */
    private $south;

    /** @var self|null */
    private $east;

    /** @var self|null */
    private $west;

    /**
     * Room constructor.
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getNord(): ?Room
    {
        return $this->nord;
    }

    public function setNord(?Room $nord): void
    {
        if ($nord) {
            $this->nord = $nord;
            $nord->south = $this;
        }
    }

    public function getSouth(): ?Room
    {
        return $this->south;
    }

    public function setSouth(?Room $south): void
    {
        if ($south) {
            $this->south = $south;
            $south->nord = $this;
        }
    }

    public function getEast(): ?Room
    {
        return $this->east;
    }

    public function setEast(?Room $east): void
    {
        if ($east) {
            $this->east = $east;
            $east->west = $this;
        }
    }

    public function getWest(): ?Room
    {
        return $this->west;
    }

    public function setWest(?Room $west): void
    {
        if ($west) {
            $this->west = $west;
            $west->east = $this;
        }
    }
}
