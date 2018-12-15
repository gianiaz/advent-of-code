<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day12;

class Tunnel
{
    /** @var string[] */
    private $pots;

    /** @var string[] */
    private $rules;

    /**
     * Tunnel constructor.
     *
     * @param string[] $pots
     * @param string[] $rules
     */
    public function __construct(array $pots, array $rules)
    {
        $this->pots = $pots;
        $this->rules = $rules;
    }

    public function getPotsToString(): string
    {
        return implode($this->pots);
    }

    public function getPots(): array
    {
        return $this->pots;
    }

    public function getNextGeneration(): self
    {
        $nextGeneration = [];
        $potNumbers = \array_keys($this->pots);
        $min = \array_shift($potNumbers);
        $max = \array_pop($potNumbers);

        foreach (range($min - 2, $max + 2) as $potNumber) {
            $state = $this->getStateAt($potNumber);

            if (\array_key_exists($state, $this->rules)) {
                $nextGeneration[$potNumber] = $this->rules[$state];
            } else {
                $nextGeneration[$potNumber] = '.';
            }
        }

        return new self($nextGeneration, $this->rules);
    }

    private function getStateAt(int $number): string
    {
        $state = '';

        foreach (range($number - 2, $number + 2) as $potNumber) {
            if (\array_key_exists($potNumber, $this->pots)) {
                $state .= $this->pots[$potNumber];
            } else {
                $state .= '.';
            }
        }

        return $state;
    }

    public function getSum(): int
    {
        $potsWithPlants = \array_filter($this->pots, function (string $pot) {
            return $pot === '#';
        });

        return \array_sum(\array_keys($potsWithPlants));
    }
}
