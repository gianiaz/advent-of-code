<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day1;

use Jean85\AdventOfCode\Xmas2018\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    /**
     * @dataProvider inputProvider
     */
    public function testSolve(string $input, int $expectedFrequency): void
    {
        $solution = new Day1Solution($input);

        $this->assertSame($expectedFrequency, $solution->solve($input));
    }

    public function inputProvider()
    {
        return [
            ['+1 +1 +1', 3],
            ['+1 +1 -2', 0],
            ['-1 -2 -3', -6],
        ];
    }
}
