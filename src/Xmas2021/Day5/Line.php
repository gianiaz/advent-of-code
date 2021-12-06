<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day5;

class Line
{
    private int $x1;
    private int $x2;
    private int $y1;
    private int $y2;

    public function __construct(string $input)
    {
        [$start, $end] = explode(' -> ', $input);
        [$this->x1, $this->y1] = $this->splitCoordinates($start);
        [$this->x2, $this->y2] = $this->splitCoordinates($end);
    }

    /**
     * @return array{int, int}
     */
    private function splitCoordinates(string $coordinates): array
    {
        [$x, $y] = explode(',', $coordinates);

        return [(int) $x, (int) $y];
    }

    /**
     * @return \Generator<array{int, int}>
     */
    public function getLine(): \Generator
    {
        foreach (range($this->x1, $this->x2) as $x) {
            foreach (range($this->y1, $this->y2) as $y) {
                yield [$x, $y];
            }
        }
    }

    public function isDiagonal(): bool
    {
        return ! ($this->x1 === $this->x2
            || $this->y1 === $this->y2)
        ;
    }
}
