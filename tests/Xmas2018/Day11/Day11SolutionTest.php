<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day11;

use Jean85\AdventOfCode\Xmas2018\Day11\Day11Solution;
use PHPUnit\Framework\TestCase;

class Day11SolutionTest extends TestCase
{
    /**
     * @dataProvider solveProvider
     */
    public function testSolve(int $serialNumber, string $expectedSolution): void
    {
        $solution = new Day11Solution($serialNumber);

        $this->assertSame($expectedSolution, $solution->solve());
    }

    public function solveProvider()
    {
        return [
            [18, '33,45'],
            [42, '21,61'],
        ];
    }
}
