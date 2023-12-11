<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day11;

use Jean85\AdventOfCode\Xmas2023\Coordinates;

class SpaceMap
{
    private readonly int $maxX;
    private readonly int $maxY;
    /** @var array<int,array<int, Coordinates>> */
    private readonly array $galaxiesByX;
    /** @var array<int,array<int, Coordinates>> */
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
            $galaxiesByX[$galaxy->x][$galaxy->y] = $galaxy;
            $galaxiesByY[$galaxy->y][$galaxy->x] = $galaxy;
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
                $print .= isset($this->galaxiesByX[$x][$y])
                    ? '#'
                    : '.'
                ;
            }

            $print .= PHP_EOL;
        }

        return trim($print);
    }

    public function expand(): self
    {
        $expanded = '';

        foreach (range(0, $this->maxY) as $y) {
            if (! isset($this->galaxiesByY[$y])) {
                $expanded .= str_repeat('.', $this->maxX + 1) . PHP_EOL;
            }

            foreach (range(0, $this->maxX) as $x) {
                if (! isset($this->galaxiesByX[$x])) {
                    $expanded .= '.';
                }

                $expanded .= isset($this->galaxiesByX[$x][$y])
                    ? '#'
                    : '.'
                ;
            }

            $expanded .= PHP_EOL;
        }

        return self::parse($expanded);
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
}
