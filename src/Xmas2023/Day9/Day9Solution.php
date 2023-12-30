<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day9;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day9Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        return (string) $this->getSolution($this->interpolateNextStep(...), $input);
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        return (string) $this->getSolution($this->interpolatePrevStep(...), $input);
    }

    protected function getSolution(callable $nextStep, string $input): int
    {
        $solution = 0;
        foreach (explode(PHP_EOL, $input) as $row) {
            $values = explode(' ', $row);
            $solution += $nextStep(...array_map(static fn(string $a): int => (int) $a, $values));
        }

        return $solution;
    }
    private function interpolatePrevStep(int ...$values): int
    {
        if ($this->itsAllZeroes($values)) {
            return 0;
        }

        $stepBelow = $this->getStepBelow($values);

        return array_shift($values)
            - $this->interpolatePrevStep(...$stepBelow);
    }

    private function interpolateNextStep(int ...$values): int
    {
        if ($this->itsAllZeroes($values)) {
            return 0;
        }

        $stepBelow = $this->getStepBelow($values);

        return array_pop($values)
            + $this->interpolateNextStep(...$stepBelow);
    }

    private function itsAllZeroes(array $values): bool
    {
        foreach ($values as $value) {
            if ($value !== 0) {
                return false;
            }
        }

        return true;
    }

    private function getStepBelow(array $values): array
    {
        $stepBelow = [];
        $iMax = count($values);
        for ($i = 1; $i < $iMax; ++$i) {
            $stepBelow[] = $values[$i] - $values[$i - 1];
        }

        return $stepBelow;
    }
}
