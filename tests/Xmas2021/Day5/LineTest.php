<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day5;

use Jean85\AdventOfCode\Xmas2021\Day5\Line;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    /**
     * @dataProvider coordinatesDataProvider
     *
     * @param array{int, int}[] $expectedCoordinates
     */
    public function test(string $input, array $expectedCoordinates): void
    {
        $line = new Line($input);

        $this->assertEquals($expectedCoordinates, iterator_to_array($line->getLine()));
    }

    /**
     * @return array{string, array{int,int}[]}[]
     */
    public function coordinatesDataProvider(): array
    {
        return [
            ['1,1 -> 1,3', [[1, 1], [1, 2], [1, 3]]],
            ['9,7 -> 7,7', [[9, 7], [8, 7], [7, 7]]],
            ['1,1 -> 3,3', [[1, 1], [2, 2], [3, 3]]],
            ['9,7 -> 7,9', [[9, 7], [8, 8], [7, 9]]],
        ];
    }
}
