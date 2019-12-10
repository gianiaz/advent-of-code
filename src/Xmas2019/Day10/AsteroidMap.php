<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

class AsteroidMap
{
    /** @var bool[][] */
    private $asteroids = [];

    /** @var int */
    private $maxX = 0;

    /** @var int */
    private $maxY = 0;

    public function __construct(string $map)
    {
        $map = trim($map);

        foreach (explode(PHP_EOL, $map) as $y => $row) {
            ++$this->maxY;
            $this->maxX = max($this->maxX, strlen($row));
            foreach (str_split($row) as $x => $position) {
                if ($position === '#') {
                    $this->asteroids[$y][$x] = true;
                }
            }
        }

        --$this->maxX;
        --$this->maxY;
    }

    public function getMaxX(): int
    {
        return $this->maxX;
    }

    public function getMaxY(): int
    {
        return $this->maxY;
    }

    /**
     * @return bool[][]
     */
    public function getAsteroids(): array
    {
        return $this->asteroids;
    }

    public function isAsteroid(int $x, int $y): bool
    {
        return $this->asteroids[$y][$x] ?? false;
    }

    public function printMap(): string
    {
        $map = '';
        foreach (range(0, $this->maxY) as $y) {
            foreach (range(0, $this->maxX) as $x) {
                $map .= $this->isAsteroid($x, $y) ? '#' : '.';
            }

            $map .= PHP_EOL;
        }

        return $map;
    }

    /**
     * @return \Generator<int[]>
     */
    public function getAsteroidsCoordinates(): \Generator
    {
        foreach ($this->asteroids as $y => $rows) {
            foreach ($rows as $x => $asteroid) {
                yield [$x, $y];
            }
        }
    }

    /**
     * @return \Generator<int[]>
     */
    public function getMapCoordinates(): \Generator
    {
        foreach (range(0, $this->maxY) as $y) {
            foreach (range(0, $this->maxX) as $x) {
                yield [$x, $y];
            }
        }
    }
}
