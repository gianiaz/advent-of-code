<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day11;

use Jean85\AdventOfCode\SolutionInterface;

class Day11Solution implements SolutionInterface
{
    /** @var PowerCalculator */
    private $calculator;

    public function __construct(int $serialNumber = 9445)
    {
        $this->calculator = new PowerCalculator($serialNumber);
    }

    public function solve()
    {
        $grid = $this->createGrid();
        $maxesGrid = $this->createGroupsCalculation($grid);

        $max = -INF;
        $bestX = $bestY = null;
        foreach ($maxesGrid as $y => $row) {
            $rowMax = max($row);
            if ($max < $rowMax) {
                $max = $rowMax;
                $bestY = $y;
                $bestX = \array_search($max, $row, true);
            }
        }

        return sprintf('%s,%s', $bestX, $bestY);
    }

    /**
     * @return int[][]
     */
    private function createGrid(): array
    {
        $grid = [];

        foreach (range(1, 300) as $y) {
            foreach (range(1, 300) as $x) {
                $grid[$y][$x] = $this->calculator->calculatePower($x, $y);
            }
        }

        return $grid;
    }

    /**
     * @param int[][] $grid
     *
     * @return int[][]
     */
    private function createGroupsCalculation(array $grid): array
    {
        $maxGrid = [];
        foreach (range(1, 298) as $y) {
            foreach (range(1, 298) as $x) {
                $maxGrid[$y][$x] = $grid[$y][$x]
                    + $grid[$y][$x + 1]
                    + $grid[$y][$x + 2]
                    + $grid[$y + 1][$x]
                    + $grid[$y + 1][$x + 1]
                    + $grid[$y + 1][$x + 2]
                    + $grid[$y + 2][$x]
                    + $grid[$y + 2][$x + 1]
                    + $grid[$y + 2][$x + 2];
            }
        }

        return $maxGrid;
    }
}
