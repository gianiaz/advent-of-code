<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day11;

use Jean85\AdventOfCode\Xmas2022\Day11\Day11Solution;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class Day11SolutionTest extends TestCase
{
    public function test(): void
    {
        $Day11Solution = new Day11Solution();

        $this->assertSame('374', $Day11Solution->solve($this->getInput()));
    }

    #[DataProvider('secondPartDataProvider')]
    public function testSecondPart(int $times, string $solution): void
    {
        $Day11Solution = new Day11Solution();

        $this->assertSame($solution, $Day11Solution->getSumOfMinimumDistances($this->getInput(), $times));
    }

    /**
     * @return array{int, string}[]
     */
    public static function secondPartDataProvider(): array
    {
        return [
            [9, '1030'],
            [99, '8410'],
        ];
    }

    private function getInput(): string
    {
        return '...#......
.......#..
#.........
..........
......#...
.#........
.........#
..........
.......#..
#...#.....';
    }
}
