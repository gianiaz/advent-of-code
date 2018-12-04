<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day3;

class Fabric
{
    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /** @var SquareInch[][] */
    private $fabric;

    /**
     * Fabric constructor.
     */
    public function __construct(int $width, int $lenght)
    {
        $this->width = $width;
        $this->height = $lenght;
    }

    public function addClaim(Claim $claim): void
    {
        foreach (range($claim->getLeft(), $claim->getLeft() + $claim->getWidth() - 1) as $left) {
            foreach (range($claim->getTop(), $claim->getTop() + $claim->getHeight() - 1) as $top) {
                $this->getSquareInch($left, $top)->addClaim($claim);
            }
        }
    }

    public function getSquareInch(int $left, int $top): SquareInch
    {
        if ($left >= $this->width) {
            throw new \OutOfRangeException();
        }

        if ($top >= $this->height) {
            throw new \OutOfRangeException();
        }

        if (! isset($this->fabric[$left][$top])) {
            $this->fabric[$left][$top] = new SquareInch();
        }

        return $this->fabric[$left][$top];
    }

    /**
     * @return \Generator|SquareInch[]
     */
    public function iterate(): \Generator
    {
        foreach (range(0, $this->height - 1) as $top) {
            foreach (range(0, $this->width - 1) as $left) {
                yield $this->getSquareInch($left, $top);
            }
        }
    }

    public function toStringArray(): string
    {
        $stringArray = '';
        foreach (range(0, $this->height - 1) as $top) {
            foreach (range(0, $this->width - 1) as $left) {
                $stringArray .= (string) $this->getSquareInch($left, $top)->getClaimCount();
            }
            $stringArray .= PHP_EOL;
        }
        $stringArray .= PHP_EOL;

        return $stringArray;
    }
}
