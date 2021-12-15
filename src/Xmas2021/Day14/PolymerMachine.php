<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day14;

class PolymerMachine
{
    private string $polymer;
    /** @var array{string, array<string, string>} */
    private array $rules = [];

    public function __construct(string $polymer, string $rules)
    {
        $this->polymer = $polymer;

        foreach (explode(PHP_EOL, $rules) as $rule) {
            [$startingCouple, $insertion] = explode(' -> ', $rule);
            $this->rules[$startingCouple] = $insertion;
        }
    }

    public function getPolymer(): string
    {
        return $this->polymer;
    }

    public function step(): void
    {
        $newPolymer = '';
        foreach (str_split($this->polymer) as $element) {
            $prevElement = substr($newPolymer, -1);
            if ($prevElement) {
                $newPolymer .= $this->rules[$prevElement . $element] ?? '';
            }

            $newPolymer .= $element;
        }

        $this->polymer = $newPolymer;
    }

    /**
     * @return array<string, int>
     */
    public function getElementCounts(): array
    {
        $elementCounts = [];

        foreach (str_split($this->polymer) as $element) {
            $elementCounts[$element] ??= 0;
            ++$elementCounts[$element];
        }

        return $elementCounts;
    }

    public function getSmartElementCounts(int $steps): array
    {
        $pairs = [];
        foreach (range(1, strlen($this->polymer) - 1) as $i) {
            $pairs[$this->polymer[$i - 1] . $this->polymer[$i]] ??= 0;
            ++$pairs[$this->polymer[$i - 1] . $this->polymer[$i]];
        }

        while ($steps-- > 0) {
            $newPairs = [];
            foreach ($pairs as $pair => $count) {
                [$firstElement, $secondElement] = str_split($pair);
                $insertion = $this->rules[$pair];
                $newPairs[$firstElement . $insertion] ??= 0;
                $newPairs[$firstElement . $insertion] += $count;
                $newPairs[$insertion . $secondElement] ??= 0;
                $newPairs[$insertion . $secondElement] += $count;
            }
            $pairs = $newPairs;
        }

        $elementCounts = [];
        foreach ($pairs as $pair => $count) {
            [$firstElement, $secondElement] = str_split($pair);
            $elementCounts[$firstElement] ??= 0;
            $elementCounts[$firstElement] += $count;
            $elementCounts[$secondElement] ??= 0;
            $elementCounts[$secondElement] += $count;
        }

        foreach ($elementCounts as $element => $count) {
            if ($count === 1) {
                continue;
            }

            $elementCounts[$element] = ceil($count / 2);
        }

        return $elementCounts;
    }
}
