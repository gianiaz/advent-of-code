<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day11;

class OctopusMap
{
    /** @var array<int, array<int, int> */
    private array $map = [];

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $value) {
                $this->map[$y][$x] = (int) $value;
            }
        }
    }

    public function getMapAsString(): string
    {
        $string = '';
        foreach ($this->map as $row) {
            $string .= implode('', $row) . PHP_EOL;
        }

        return trim($string);
    }

    public function step(): int
    {
        array_walk_recursive($this->map, static fn (&$value) => is_int($value) ? $value++ : null);

        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $value) {
                if ($value === 10) {
                    $this->flash($x, $y);
                }
            }
        }

        $flashCounter = 0;
        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $value) {
                if ($this->map[$y][$x] >= 11) {
                    $this->map[$y][$x] = 0;
                    ++$flashCounter;
                }
            }
        }

        return $flashCounter;
    }

    private function flash(int $startX, int $startY): void
    {
        $this->map[$startY][$startX] = 11;

        foreach (range($startY - 1, $startY + 1) as $y) {
            foreach (range($startX - 1, $startX + 1) as $x) {
                if (! isset($this->map[$y][$x])) {
                    continue;
                }

                if (++$this->map[$y][$x] === 10) {
                    $this->flash($x, $y);
                }
            }
        }
    }
}
