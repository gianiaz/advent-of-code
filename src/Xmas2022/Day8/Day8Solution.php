<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day8;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day8Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $map = $this->prepareMap($input);

        $result = 0;

        foreach ($map as $row => $line) {
            foreach ($line as $col => $tree) {
                if ($this->isVisible($map, $row, $col)) {
                    ++$result;
                }
            }
        }

        return (string) $result;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return (string) '';
    }

    /**
     * @return int[][]
     */
    private function prepareMap(?string $input): array
    {
        /** @var int[][] $map */
        $map = [];

        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        foreach (explode(PHP_EOL, $input) as $row => $line) {
            foreach (str_split($line) as $col => $tree) {
                if (1 !== \Safe\preg_match('/^\d$/', $tree)) {
                    throw new \InvalidArgumentException('Wrong tree parsed: ' . $tree);
                }

                $map[$row][$col] = (int) $tree;
            }
        }

        return $map;
    }

    private function isVisible(array $map, int $row, int $col): bool
    {
        return $this->checkVisibility($map, $row, $col, 1, 0)
            || $this->checkVisibility($map, $row, $col, -1, 0)
            || $this->checkVisibility($map, $row, $col, 0, 1)
            || $this->checkVisibility($map, $row, $col, 0, -1)
        ;
    }

    private function checkVisibility(array $map, int $row, int $col, int $addRow, int $addCol): bool
    {
        $tree = $map[$row][$col];
        $row += $addRow;
        $col += $addCol;

        while (isset($map[$row][$col])) {
            if ($map[$row][$col] >= $tree) {
                return false;
            }

            $row += $addRow;
            $col += $addCol;
        }

        return true;
    }
}
