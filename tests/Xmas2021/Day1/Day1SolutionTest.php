<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day1;

use Jean85\AdventOfCode\Xmas2021\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    /**
     * @dataProvider inputProvider
     */
    public function test(int $expected, array $input): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame($expected, $day1Solution->solve($input));
    }

    public function inputProvider(): array
    {
        return [
            [
                7, [199, 200, 208, 210, 200, 207, 240, 269, 260, 263],
            ],
        ];
    }
}
