<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day1;

use Jean85\AdventOfCode\Xmas2020\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    /**
     * @dataProvider inputProvider
     */
    public function test(array $input): void
    {
        $day1Solution = new Day1Solution();

        $this->assertSame(514579, $day1Solution->solve($input));
    }

    public function inputProvider(): array
    {
        return [
            [[1721, 299]],
            [[1721, 979, 366, 299, 675, 1456]],
        ];
    }
}
