<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day1;

use Jean85\AdventOfCode\Xmas2018\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    /**
     * @dataProvider firstInputProvider
     */
    public function testSolve(string $input, int $expectedFrequency): void
    {
        $solution = new Day1Solution($input);

        $this->assertSame($expectedFrequency, $solution->solve($input));
    }

    public function firstInputProvider()
    {
        return [
            ['+1 +1 +1', 3],
            ['+1 +1 -2', 0],
            ['-1 -2 -3', -6],
        ];
    }

    /**
     * @dataProvider secondInputProvider
     */
    public function testSolveSecondPart(string $input, int $expectedFrequency): void
    {
        $solution = new Day1Solution($input);

        $this->assertSame($expectedFrequency, $solution->solveSecondPart($input));
    }

    public function secondInputProvider()
    {
        return [
            ['+1 -1', 0],
            ['+3 +3 +4 -2 -4', 10],
            ['-6 +3 +8 +5 -6', 5],
            ['+7 +7 -2 -7 -4', 14],
        ];
    }
}
