<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day12;

class Tunnel
{
    /** @var string */
    private $pots;

    /** @var string[] */
    private $rules;

    /** @var int */
    private $firstPotNumber;

    public function __construct(string $pots, array $rules)
    {
        $this->firstPotNumber = 0;
        $this->pots = $pots;
        $this->rules = $rules;
    }

    public function getPots(): string
    {
        return $this->pots;
    }

    public function evolve(): void
    {
        $this->reducePots();

        $potLengths = \strlen($this->pots) - 5;

        $newGeneration = '';

        foreach (\range(0, $potLengths) as $potNumber) {
            $newGeneration .= $this->rules[\substr($this->pots, $potNumber, 5)] ?? '.';
        }

        $this->pots = '..' . $newGeneration;
    }

    public function getSum(): int
    {
        $potsWithPlants = \array_filter(str_split($this->pots), function (string $pot) {
            return $pot === '#';
        });

        return \array_sum(\array_keys($potsWithPlants)) + ($this->firstPotNumber * \count($potsWithPlants));
    }

    public function getFirstPotNumber(): int
    {
        return $this->firstPotNumber;
    }

    private function reducePots(): void
    {
        if (\strpos(\substr($this->pots, 0, 4), '#') !== false) {
            $this->pots = '....' . $this->pots;
            $this->firstPotNumber -= 4;
        }

        $originalLenght = \strlen($this->pots);
        $this->pots = \ltrim($this->pots, '.');
        $this->firstPotNumber += $originalLenght - \strlen($this->pots) - 3;
        $this->pots = '...' . rtrim($this->pots, '.') . '...';
    }
}
