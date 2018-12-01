<?php

declare(strict_types=1);

namespace Tests\Xmas2017;

use Jean85\AdventOfCode\Xmas2017\Day1\Day1Solution;
use PHPUnit\Framework\TestCase;

class Day1SolutionTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSolution(string $input, array $expectedNumbers, int $expectedSum)
    {
        $solution = new Day1Solution($input);

        $this->assertSame($expectedNumbers, $solution->getMatchingNumbers());
        $this->assertSame($expectedSum, $solution->solve());
    }

    public function dataProvider()
    {
        yield ['1122', [1, 2], 3];
        yield ['1111', [1, 1, 1, 1], 4];
        yield ['1234', [], 0];
        yield ['91212129', [9], 9];
    }

    /**
     * @dataProvider dataProviderPartTwo
     *
     * @param array $expectedNumbers
     */
    public function testPartTwo(string $input, ?array $expectedNumbers, int $expectedSum)
    {
        $solution = new Day1Solution($input);

        if ($expectedNumbers) {
            $this->assertSame($expectedNumbers, $solution->getMatchingNumbersForSecondPart());
        }
        $this->assertSame($expectedSum, $solution->solveSecondPart());
    }

    public function dataProviderPartTwo()
    {
        yield ['1212', [1, 2, 1, 2], 6];
        yield ['1221', [], 0];
        yield ['123123', null, 12];
        yield ['12131415', null, 4];
    }
}
