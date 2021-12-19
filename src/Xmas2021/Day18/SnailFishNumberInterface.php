<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

interface SnailFishNumberInterface
{
    public function getMagnitude(): int;

    public function goDownAndSumToTheLeft(NormalNumber $number): void;

    public function goDownAndSumToTheRight(NormalNumber $number): void;

    public function reduce(int $nesting = 0): bool;

    public function setUp(SnailFishNumber $up): void;
}
