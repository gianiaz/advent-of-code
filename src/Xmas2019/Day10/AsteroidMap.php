<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

class AsteroidMap
{
    /** @var bool[][] */
    private $asteroids = [];

    public function __construct(string $map)
    {
        $map = trim($map);

        foreach (explode(PHP_EOL, $map) as $y => $row) {
            foreach (str_split($row) as $x => $position) {
                $this->asteroids[$y][$x] = $position === '#';
            }
        }
    }

    public function isAsteroid(int $x, int $y): bool
    {
        return $this->asteroids[$y][$x] ?? false;
    }

    public function printMap(): string
    {
        $map = '';
        foreach ($this->asteroids as $row) {
            foreach ($row as $cell) {
                $map .= $cell ? '#' : '.';
            }

            $map .= PHP_EOL;
        }

        return $map;
    }
}
