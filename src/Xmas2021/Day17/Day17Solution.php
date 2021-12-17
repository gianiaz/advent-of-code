<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day17;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day17Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const INPUT = 'target area: x=102..157, y=-146..-90';
    /** @var array<int, int[]> steps => velocity[] */
    private array $possibleXVelocities;
    /** @var array<int, int[]> steps => velocity[] */
    private array $possibleYVelocities;
    /** @var array<int, int> YVelocity => maxHeight */
    private array $maxHeights;
    /** @var string[] */
    public array $validCombinations;

    public function solve(string $input = self::INPUT)
    {
        $target = new TargetArea($input);

        $this->calculatePossibleXVelocities($target);
        $this->calculatePossibleYVelocities($target);
        $maxHeight = 0;

        foreach (array_keys($this->possibleXVelocities) as $stepsAtWhichWeHit) {
            foreach ($this->possibleYVelocities[$stepsAtWhichWeHit] ?? [] as $yVelocity) {
                $maxHeight = max($maxHeight, $this->maxHeights[$yVelocity] ?? 0);
            }
        }

        return $maxHeight;
    }

    public function solveSecondPart(string $input = self::INPUT)
    {
        $target = new TargetArea($input);

        $this->calculatePossibleXVelocities($target);
        $this->calculatePossibleYVelocities($target);

        $this->validCombinations = [];

        foreach ($this->possibleXVelocities as $stepsAtWhichWeHit => $xVelocities) {
            foreach ($this->possibleYVelocities[$stepsAtWhichWeHit] ?? [] as $yVelocity) {
                foreach ($xVelocities as $xVelocity) {
                    $combination = $xVelocity . ',' . $yVelocity;
                    $this->validCombinations[$combination] = $combination;
                }
            }
        }

        sort($this->validCombinations);

        return count($this->validCombinations);
    }

    private function calculatePossibleXVelocities(TargetArea $target): void
    {
        $xVelocity = $target->getMaxX();
        $this->possibleXVelocities = [];

        do {
            $position = 0;
            $currentVelocity = $xVelocity;
            $steps = 1;
            $stillSteps = 0;
            do {
                $position += $currentVelocity;
                if ($currentVelocity > 0) {
                    --$currentVelocity;
                } elseif ($currentVelocity < 0) {
                    ++$currentVelocity;
                } else {
                    ++$stillSteps;
                }

                if ($target->isInside(x: $position)) {
                    $this->possibleXVelocities[$steps][] = $xVelocity;
                }
                ++$steps;
            } while ($position <= $target->getMaxX() && $stillSteps < 1000);
        } while (--$xVelocity);
    }

    private function calculatePossibleYVelocities(TargetArea $target): void
    {
        $yVelocity = min(1, $target->getMinY());
        $this->possibleYVelocities = [];

        if (empty($this->possibleXVelocities)) {
            $this->calculatePossibleXVelocities($target);
        }
        $maxSteps = max(array_keys($this->possibleXVelocities));

        do {
            $position = 0;
            $currentVelocity = $yVelocity;
            $steps = 0;
            do {
                ++$steps;

                $position += $currentVelocity--;
                if ($currentVelocity === 0) {
                    $this->maxHeights[$yVelocity] = $position;
                }

                if ($target->isInside(y: $position)) {
                    $this->possibleYVelocities[$steps][] = $yVelocity;
                }
            } while ($steps <= $maxSteps && $position >= $target->getMinY());
            ++$yVelocity;
        } while ($yVelocity <= abs($target->getMinY())); // overshoot: too fast when falling down, first step below 0 is already below target
    }
}
