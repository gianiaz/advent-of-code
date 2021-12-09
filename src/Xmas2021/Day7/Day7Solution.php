<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day7;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day7Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var array<int,int> */
    private array $memoizedCosts = [];

    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $positions = explode(',', $input);
        $optimalFuel = PHP_INT_MAX;
        foreach (range(min($positions), max($positions)) as $position) {
            $fuel = 0;
            foreach ($positions as $crab) {
                $fuel += abs($crab - $position);
            }

            if ($fuel < $optimalFuel) {
                $optimalFuel = $fuel;
            }
        }

        return $optimalFuel;
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $positions = explode(',', $input);
        $fuelCosts = [];

        $min = min($positions);
        $max = max($positions);

        foreach (range($min, $max) as $targetPosition) {
            $fuelCosts[$targetPosition] ??= $this->calculateTotalFuelCost($positions, $targetPosition);
        }

        return min($fuelCosts);
    }

    private function calculateTotalFuelCost(array $positions, int $targetPosition): int
    {
        $fuel = 0;
        foreach ($positions as $crab) {
            $distance = abs($crab - $targetPosition);
            $fuel += $this->calculateFuelCostPerDistance($distance);
        }

        return $fuel;
    }

    private function calculateFuelCostPerDistance(int $distance): int
    {
        $total = 0;
        $current = 0;

        do {
            $total += $current;
            $this->memoizedCosts[$current] ??= $total;
        } while (++$current <= $distance);

        return $total;
    }
}
