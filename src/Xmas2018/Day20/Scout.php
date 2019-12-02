<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day20;

class Scout
{
    /** @var Room */
    private $room;

    /** @var string */
    private $path = '';

    /**
     * Scout constructor.
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function addStepToPath(string $step): void
    {
        $this->path .= $step;
    }
}
