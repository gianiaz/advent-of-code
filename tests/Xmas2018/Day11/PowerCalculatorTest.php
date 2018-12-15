<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day11;

use Jean85\AdventOfCode\Xmas2018\Day11\PowerCalculator;
use PHPUnit\Framework\TestCase;

class PowerCalculatorTest extends TestCase
{
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculate(int $x, int $y, int $serialNumber, int $power): void
    {
        $calculator = new PowerCalculator($serialNumber);

        $this->assertSame($power, $calculator->calculatePower($x, $y));
    }

    public function calculateDataProvider(): array
    {
        return [
            [3, 5, 8, 4],
            [122, 79, 57, -5],
            [217, 196, 39, 0],
            [101, 153, 71, 4],
        ];
    }
}
