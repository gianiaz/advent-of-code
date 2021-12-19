<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

class NormalNumber implements SnailFishNumberInterface
{
    public function __construct(
        private int $value,
        private SnailFishNumber $up
    ) {
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
            $splitNumber = SnailFishNumber::createManually(
                new self((int) floor($this->value / 2), $this->up),
                new self((int) ceil($this->value / 2), $this->up)
            );

            if ($this->up->getLeft() === $this) {
                $this->up->setLeft($splitNumber);
            } else {
                $this->up->setRight($splitNumber);
            }

            return true;
        }

        return false;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function setUp(SnailFishNumber $up): void
    {
        $this->up = $up;
    }
}
