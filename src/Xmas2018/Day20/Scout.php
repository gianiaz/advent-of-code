<?php

namespace Jean85\AdventOfCode\Xmas2018\Day20;

class Scout
{
    /** @var Room */
    private $room;
    
    /** @var string */
    private $path = '';

    /**
     * Scout constructor.
     * @param Room $room
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function addStepToPath(string $step): void
    {
        $this->path .= $step;
    }
}
