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
}
