<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day11;

use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;
use Jean85\AdventOfCode\Xmas2019\Day7\MemoryWithSequentialIO;

class RobotPainter
{
    /** @var IntcodeComputer */
    private $brain;

    /** @var EmergencyHull */
    private $hull;

    /** @var Compass */
    private $compass;

    /** @var int */
    private $x = 0;

    /** @var int */
    private $y = 0;

    public function __construct(IntcodeComputer $brain, EmergencyHull $hull)
    {
        $this->brain = $brain;
        $this->hull = $hull;
        $this->compass = new Compass();
    }

    public function paint(MemoryWithSequentialIO $memory): void
    {
        $this->setInputFromHullColor($memory);

        while ($this->execute($memory)) {
            $color = $memory->getOutput();
            $this->hull->paint($this->x, $this->y, $color);

            $this->advance($memory);

            $this->setInputFromHullColor($memory);
        }
    }

    private function advance(MemoryWithSequentialIO $memory): void
    {
        $direction = $memory->getOutput();

        $nextDirection = $this->compass->nextDirection($direction);
        $this->x += $nextDirection->getX();
        $this->y += $nextDirection->getY();
    }

    private function setInputFromHullColor(MemoryWithSequentialIO $memory): void
    {
        $memory->setInput(
            $this->hull->getColor($this->x, $this->y)
        );
    }

    private function execute(MemoryWithSequentialIO $memory): bool
    {
        try {
            return $this->brain->run($memory);
        } catch (\TypeError $error) {
            return true;
        }
    }
}
