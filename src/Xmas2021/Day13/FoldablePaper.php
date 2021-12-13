<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day13;

class FoldablePaper
{
    /** @var array<int, array<int, true>> */
    private array $dots = [];
    private int $maxX = 0;
    private int $maxY = 0;

    public function __construct(string $dotsCoordinates)
    {
        foreach (explode(PHP_EOL, $dotsCoordinates) as $coordinates) {
            [$x, $y] = explode(',', $coordinates);
            $x = (int) $x;
            $y = (int) $y;
            $this->dots[$y][$x] = true;
            $this->maxX = max($this->maxX, $x);
        }

        $this->maxY = max(array_keys($this->dots));
    }

    public function getPaper(): string
    {
        $map = '';
        foreach (range(0, $this->maxY) as $y) {
            foreach (range(0, $this->maxX) as $x) {
                $map .= isset($this->dots[$y][$x]) ? '#' : '.';
            }
            $map .= PHP_EOL;
        }

        return trim($map);
    }

    public function foldY(int $foldY): void
    {
        unset($this->dots[$foldY]);

        foreach (range($foldY + 1, $this->maxY) as $y) {
            foreach ($this->dots[$y] ?? [] as $x => $value) {
                $this->dots[$foldY - ($y - $foldY)][$x] = true;
            }

            unset($this->dots[$y]);
        }

        $this->maxY = $foldY - 1;
    }

    public function foldX(int $foldX): void
    {
        foreach ($this->dots as $y => $row) {
            unset($this->dots[$y][$foldX]);
            foreach (range($foldX + 1, $this->maxX) as $x) {
                if (isset($this->dots[$y][$x])) {
                    $this->dots[$y][$foldX - ($x - $foldX)] = true;
                    unset($this->dots[$y][$x]);
                }
            }
        }

        $this->maxX = $foldX - 1;
    }
}
