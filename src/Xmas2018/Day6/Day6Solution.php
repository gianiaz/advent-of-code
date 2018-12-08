<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day6;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day6Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var Point[] */
    private $points;

    /** @var Grid */
    private $grid;

    /** @var int */
    private $maximumSumDistance;

    /**
     * Day6Solution constructor.
     *
     * @param Point[] $points
     */
    public function __construct(array $points = null, int $maximumSumDistance = 10000)
    {
        $this->points = $points ?? $this->getInput();

        $maxWidth = 0;
        $maxHeight = 0;
        foreach ($this->points as $point) {
            if ($point->getX() > $maxWidth) {
                $maxWidth = $point->getX();
            }
            if ($point->getY() > $maxHeight) {
                $maxHeight = $point->getY();
            }
        }

        $this->grid = new Grid($maxWidth + 1, $maxHeight + 1);
        $this->maximumSumDistance = $maximumSumDistance;
    }

    public function solve()
    {
        $this->populateGridWithDistances();
        $areaCounts = $this->excludeInfiniteAreas($this->grid->getCounts());

        return $areaCounts[\count($areaCounts) - 1];
    }

    public function solveSecondPart()
    {
        $this->populateGridWithSums();

        $validCells = 0;
        foreach (range(0, $this->grid->getWidth() - 1) as $x) {
            foreach (range(0, $this->grid->getHeight() - 1) as $y) {
                if ($this->grid->get($x, $y) < $this->maximumSumDistance) {
                    ++$validCells;
                }
            }
        }

        return $validCells;
    }

    private function getNearest(int $x, int $y): string
    {
        $nearest = 'X';
        $minDistance = INF;
        $currentPoint = new Point($x, $y);

        foreach ($this->points as $name => $point) {
            $distance = $currentPoint->getDistance($point);

            if ($distance === 0) {
                return (string) $name;
            }

            if ($distance === $minDistance) {
                $nearest = '.';
            } elseif ($distance < $minDistance) {
                $nearest = (string) $name;
                $minDistance = $distance;
            }
        }

        return $nearest;
    }

    private function populateGridWithDistances(): void
    {
        foreach (range(0, $this->grid->getWidth() - 1) as $x) {
            foreach (range(0, $this->grid->getHeight() - 1) as $y) {
                $this->grid->set($this->getNearest($x, $y), $x, $y);
            }
        }
    }

    private function populateGridWithSums()
    {
        foreach (range(0, $this->grid->getWidth() - 1) as $x) {
            foreach (range(0, $this->grid->getHeight() - 1) as $y) {
                $this->grid->set($this->getDistanceSum($x, $y), $x, $y);
            }
        }
    }

    private function getDistanceSum(int $x, int $y): int
    {
        $sumDistance = 0;
        $currentPoint = new Point($x, $y);

        foreach ($this->points as $name => $point) {
            $sumDistance += $currentPoint->getDistance($point);
        }

        return $sumDistance;
    }

    private function excludeInfiniteAreas(array $counts): array
    {
        foreach ([0, $this->grid->getWidth() - 1] as $x) {
            foreach (range(0, $this->grid->getHeight() - 1) as $y) {
                $name = $this->grid->get($x, $y);

                if (\array_key_exists($name, $counts)) {
                    unset($counts[$name]);
                }
            }
        }

        foreach ([0, $this->grid->getHeight() - 1] as $y) {
            foreach (range(0, $this->grid->getWidth() - 1) as $x) {
                $name = $this->grid->get($x, $y);

                if (\array_key_exists($name, $counts)) {
                    unset($counts[$name]);
                }
            }
        }

        sort($counts);

        return $counts;
    }

    /**
     * @return Point[]
     */
    private function getInput(): array
    {
        return [
            new Point(84, 212),
            new Point(168, 116),
            new Point(195, 339),
            new Point(110, 86),
            new Point(303, 244),
            new Point(228, 338),
            new Point(151, 295),
            new Point(115, 49),
            new Point(161, 98),
            new Point(60, 197),
            new Point(40, 55),
            new Point(55, 322),
            new Point(148, 82),
            new Point(86, 349),
            new Point(145, 295),
            new Point(243, 281),
            new Point(91, 343),
            new Point(280, 50),
            new Point(149, 129),
            new Point(174, 119),
            new Point(170, 44),
            new Point(296, 148),
            new Point(152, 160),
            new Point(115, 251),
            new Point(266, 281),
            new Point(269, 285),
            new Point(109, 242),
            new Point(136, 241),
            new Point(236, 249),
            new Point(338, 245),
            new Point(71, 101),
            new Point(254, 327),
            new Point(208, 231),
            new Point(289, 184),
            new Point(282, 158),
            new Point(352, 51),
            new Point(326, 230),
            new Point(88, 240),
            new Point(292, 342),
            new Point(352, 189),
            new Point(231, 141),
            new Point(280, 350),
            new Point(296, 185),
            new Point(226, 252),
            new Point(172, 235),
            new Point(137, 161),
            new Point(207, 90),
            new Point(101, 133),
            new Point(156, 234),
            new Point(241, 185),
        ];
    }
}
