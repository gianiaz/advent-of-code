<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day11;

class PowerCalculator
{
    /** @var int */
    private $serialNumber;

    /**
     * PowerCalculator constructor.
     */
    public function __construct(int $serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    public function calculatePower(int $x, int $y): int
    {
        $rackId = $x + 10;
        $power = $rackId * $y;
        $power += $this->serialNumber;
        $power *= $rackId;
        $hundredsDigit = (int) \substr((string) $power, -3, 1);

        return $hundredsDigit - 5;
    }
}
