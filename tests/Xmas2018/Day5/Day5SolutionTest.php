<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day5;

use Jean85\AdventOfCode\Xmas2018\Day5\Day5Solution;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    /**
     * @dataProvider stepDataProvider
     */
    public function testStep(string $polymer, string $expectedResult): void
    {
        $solution = new Day5Solution();

        $this->assertSame($expectedResult, $solution->step($polymer));
    }

    public function stepDataProvider()
    {
        return [
            ['AA', 'AA'],
            ['dabAcCaCBAcCcaDA', 'dabAaCBAcCcaDA'],
            ['dabAaCBAcCcaDA', 'dabCBAcCcaDA'],
            ['dabCBAcCcaDA', 'dabCBAcaDA'],
            ['dabCBAcaDA', 'dabCBAcaDA'],
        ];
    }

    public function testReducePolymer(): void
    {
        $solution = new Day5Solution();

        $this->assertSame('dabCBAcaDA', $solution->reducePolymer('dabAcCaCBAcCcaDA'));
    }

    public function testSolve(): void
    {
        $solution = new Day5Solution('dabAcCaCBAcCcaDA');

        $this->assertSame(\strlen('dabCBAcaDA'), $solution->solve());
    }
}
