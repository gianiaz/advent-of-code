<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day15;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day15Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private int $maxX = 0;
    private int $maxY = 0;
    /** @var array<int, array<int, int>> */
    private array $map = [];
    /** @var array<int, array<int, int>> */
    private array $risk = [];

    public function solve(string $input = null)
    {
        $this->init($input);
        $this->explore(0, 0, 0);

        return $this->risk[$this->maxY][$this->maxX];
    }

    public function solveSecondPart(string $input = null)
    {
        $this->init($input);
        $this->mirrorMap();
        $this->explore(0, 0, 0);

        return $this->risk[$this->maxY][$this->maxX];
    }

    public function getMap(): string
    {
        $map = '';
        foreach ($this->map as $y => $row) {
            $map .= implode($row) . PHP_EOL;
        }

        return trim($map);
    }

    private function init(?string $input): void
    {
        $this->risk = [];
        $this->risk[0][0] = 0;

        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $value) {
                $this->map[$y][$x] = (int) $value;
            }
            $this->maxX = max($this->maxX, $x);
        }
        $this->maxY = $y;
    }

    private function explore(int $startX, int $startY, int $currentRisk): void
    {
        if ($startX === $this->maxX && $startY === $this->maxY) {
            return;
        }

        $possibleMoves = [
            [$startX, $startY + 1], // down
            [$startX + 1, $startY], // right
            [$startX - 1, $startY], // left
            [$startX, $startY - 1], // up
        ];

        foreach ($possibleMoves as $move) {
            [$x, $y] = $move;

            if (! isset($this->map[$y][$x])) {
                continue;
            }

            $nextRisk = $currentRisk + $this->map[$y][$x];
            if ($nextRisk > ($this->risk[$this->maxY][$this->maxX] ?? PHP_INT_MAX)) {
                continue;
            }

            $alreadyVisitedAtRisk = $this->risk[$y][$x] ?? PHP_INT_MAX;
            if ($nextRisk < $alreadyVisitedAtRisk) {
                $this->risk[$y][$x] = $nextRisk;
                $this->explore($x, $y, $this->risk[$y][$x]);
            }
        }
    }

    private function mirrorMap(): void
    {
        $originalMap = $this->map;

        foreach (range(0, 4) as $iterationY) {
            $additionalY = $iterationY * (1 + $this->maxY);
            foreach (range(0, 4) as $iterationX) {
                if ($iterationY === 0 && $iterationX === 0) {
                    continue;
                }

                $additionalX = $iterationX * (1 + $this->maxX);
                foreach ($originalMap as $y => $row) {
                    foreach ($row as $x => $value) {
                        $this->map[$y + $additionalY][$x + $additionalX] = 1 + ($originalMap[$y][$x] + $iterationX + $iterationY - 1) % 9;
                    }
                }
            }
        }

        $this->maxX = max(array_keys($this->map[0]));
        $this->maxY = max(array_keys($this->map));
    }
}
