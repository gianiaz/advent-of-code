<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

class NormalNumber implements SnailFishNumberInterface
{
    public function __construct(private int $value)
    {
    }

    public function add(self $number): void
    {
        $this->value += $number->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getMagnitude(): int
    {
        return $this->value;
    }

    public function goDownAndSumToTheLeft(NormalNumber $number): void
    {
        $this->add($number);
    }

    public function goDownAndSumToTheRight(NormalNumber $number): void
    {
        $this->add($number);
    }

    public function reduce(int $nesting = 0): bool
    {
        if ($this->value > 9) {
            // TODO

            return true;
        }

        return false;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}