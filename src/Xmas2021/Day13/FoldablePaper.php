<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day13;

class FoldablePaper
{
    /** @var array<int, array<int, true>> */
    private array $dots;
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
            $this->maxY = max($this->maxY, $y);
        }
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
}
