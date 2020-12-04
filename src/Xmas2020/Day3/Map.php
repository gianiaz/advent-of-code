<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day3;

class Map
{
    /** @var bool[][] array */
    private array $map = [];
    private int $maxX = 0;
    private int $maxY = 0;

    public function __construct(string $input)
    {
        $rows = explode("\n", trim($input));
        foreach ($rows as $y => $row) {
            $this->maxY = max($y + 1, $this->maxY);
            foreach (str_split($row) as $x => $char) {
                $this->maxX = max($x + 1, $this->maxX);
                if ($char === '#') {
                    $this->map[$x + 1][$y + 1] = true;
                }
            }
        }
    }

    public function hasTree(int $x, int $y): bool
    {
        if ($x <= 0) {
            throw new \InvalidArgumentException('X 0 or less');
        }

        if ($y <= 0) {
            throw new \InvalidArgumentException('Y 0 or less');
        }

        $xNormalized = $x % $this->maxX;
        if ($xNormalized === 0) {
            $xNormalized = $this->maxX;
        }

        return $this->map[$xNormalized][$y] ?? false;
    }

    public function getMaxY(): int
    {
        return $this->maxY + 1;
    }
}
