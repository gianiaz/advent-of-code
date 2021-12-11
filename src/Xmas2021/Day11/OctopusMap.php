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
}
