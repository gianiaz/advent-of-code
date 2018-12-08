<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day6;

class Grid
{
    /** @var string[][] */
    private $grid;
    /** @var int */
    private $width;
    /** @var int */
    private $height;

    /**
     * Grid constructor.
     */
    public function __construct(int $width, int $height)
    {
        $this->grid = [];

        for ($y = 0; $y < $height; ++$y) {
            for ($x = 0; $x < $width; ++$x) {
                $this->grid[$y][$x] = '.';
            }
        }

        $this->width = $width;
        $this->height = $height;
    }

    public function get(int $x, int $y): string
    {
        return $this->grid[$y][$x];
    }

    public function set(string $val, int $x, int $y)
    {
        if (! isset($this->grid[$y][$x])) {
            echo PHP_EOL;
            echo PHP_EOL;
            echo $this->__toString();
            echo PHP_EOL;
            echo PHP_EOL;
            throw new \OutOfBoundsException($x . ' ' . $y);
        }

        $this->grid[$y][$x] = $val;
    }

    public function getCounts()
    {
        $counts = [];

        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                if (! \array_key_exists($cell, $counts)) {
                    $counts[$cell] = 0;
                }

                ++$counts[$cell];
            }
        }

        return $counts;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function __toString(): string
    {
        $grid = '';

        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                $grid .= $cell;
            }
            $grid .= PHP_EOL;
        }

        return $grid;
    }
}
