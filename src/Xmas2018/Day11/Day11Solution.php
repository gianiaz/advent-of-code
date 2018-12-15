<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day11;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day11Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var PowerCalculator */
    private $calculator;

    public function __construct(int $serialNumber = 9445)
    {
        $this->calculator = new PowerCalculator($serialNumber);
    }

    public function solve()
    {
        $squareSize = 3;
        $grid = $this->createGrid();

        [$max, $bestX, $bestY] = $this->calculateBestSquare($grid, $squareSize);

        return sprintf('%s,%s', $bestX, $bestY);
    }

    public function solveSecondPart()
    {
        $grid = $this->createGrid();
        $bestSquareSize = 14;

        [$bestPower, $bestX, $bestY] = $this->calculateBestSquare($grid, $bestSquareSize);
        echo sprintf('Size %d, max %d: %s,%s,%s', $bestSquareSize, $bestPower, $bestX, $bestY, $bestSquareSize) . PHP_EOL;

        foreach (range(1, 300) as $squareSize) {
            [$max, $bestX, $bestY] = $this->calculateBestSquare($grid, $squareSize);
            echo sprintf('Size %d, max %d @ %d,%d', $squareSize, $max, $bestX, $bestY) . PHP_EOL;

            if ($max > $bestPower) {
                $bestPower = $max;
                $bestSquareSize = $squareSize;
            }

            gc_collect_cycles();
        }

        return sprintf('%s,%s,%s', $bestX, $bestY, $bestSquareSize);
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

    private function calculateBestSquare(array $grid, int $squareSize): array
    {
        $maxesGrid = $this->createGroupsCalculation($grid, $squareSize);

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

        return [$max, $bestX, $bestY];
    }

    /**
     * @param int[][] $grid
     *
     * @return int[][]
     */
    private function createGroupsCalculation(array $grid, int $squareSize): array
    {
        $maxGrid = [];
        foreach (range(1, 301 - $squareSize) as $y) {
            foreach (range(1, 301 - $squareSize) as $x) {
                $maxGrid[$y][$x] = 0;
                foreach (range(0, $squareSize - 1) as $squareY) {
                    foreach (range(0, $squareSize - 1) as $squareX) {
                        $maxGrid[$y][$x] += $grid[$y + $squareY][$x + $squareX];
                    }
                }
            }
        }

        return $maxGrid;
    }
}
