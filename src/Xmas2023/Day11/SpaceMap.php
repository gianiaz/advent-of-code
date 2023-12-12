<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day11;

use Jean85\AdventOfCode\Xmas2023\Coordinates;

class SpaceMap
{
    private readonly int $maxX;
    private readonly int $maxY;
    /** @var array<string,array<string, Coordinates>> */
    private readonly array $galaxiesByX;
    /** @var array<string,array<string, Coordinates>> */
    private readonly array $galaxiesByY;

    public function __construct(
        /** @var Coordinates[] */
        private readonly array $galaxies,
    ) {
        $maxX = 0;
        $maxY = 0;
        $galaxiesByX = [];
        $galaxiesByY = [];

        foreach ($this->galaxies as $galaxy) {
            $galaxiesByX[$this->toString($galaxy->x)][$this->toString($galaxy->y)] = $galaxy;
            $galaxiesByY[$this->toString($galaxy->y)][$this->toString($galaxy->x)] = $galaxy;
            $maxX = max($galaxy->x, $maxX);
            $maxY = max($galaxy->y, $maxY);
        }

        $this->maxX = $maxX;
        $this->maxY = $maxY;
        $this->galaxiesByX = $galaxiesByX;
        $this->galaxiesByY = $galaxiesByY;
    }

    public static function parse(string $input): self
    {
        $galaxies = [];

        foreach (explode(PHP_EOL, trim($input)) as $y => $row) {
            foreach (str_split($row) as $x => $char) {
                if ($char === '#') {
                    $galaxies[] = new Coordinates($x, $y);
                }
            }
        }

        return new self($galaxies);
    }

    public function print(): string
    {
        $print = '';

        foreach (range(0, $this->maxY) as $y) {
            foreach (range(0, $this->maxX) as $x) {
                $print .= isset($this->galaxiesByX[$this->toString($x)][$this->toString($y)])
                    ? '#'
                    : '.'
                ;
            }

            $print .= PHP_EOL;
        }

        return trim($print);
    }

    public function expand(int $times = 1): self
    {
        // expand in X only
        $galaxies = [];
        $addToX = 0;
        foreach (range(0, $this->maxX) as $x) {
            $x = $this->toString($x);
            if (! isset($this->galaxiesByX[$x])) {
                $addToX += $times;
                continue;
            }

            foreach ($this->galaxiesByX[$x] as $galaxy) {
                $galaxies[] = new Coordinates($galaxy->x + $addToX, $galaxy->y);
            }
        }

        $new = new self($galaxies);

        // now expand by Y
        $galaxies = [];
        $addToY = 0;
        foreach (range(0, $this->maxY) as $y) {
            $y = $this->toString($y);
            if (! isset($new->galaxiesByY[$y])) {
                $addToY += $times;
                continue;
            }

            foreach ($new->galaxiesByY[$y] as $galaxy) {
                $galaxies[] = new Coordinates($galaxy->x, $galaxy->y + $addToY);
            }
        }

        return new self($galaxies);
    }

    /**
     * @return \Generator<int>
     */
    public function getMinimumDistances(): \Generator
    {
        foreach ($this->galaxies as $i => $galaxy) {
            for ($j = $i + 1; isset($this->galaxies[$j]); ++$j) {
                yield $galaxy->getManhattanDistanceFrom($this->galaxies[$j]);
            }
        }
    }

    private function toString(int $x): string
    {
        return '_' . (string) $x;
    }
}
