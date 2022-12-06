<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day6;

use Jean85\AdventOfCode\Xmas2022\Day6\Day6Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    /**
     * @dataProvider inputDataProvider
     */
    public function test(string $input, int $expected): void
    {
        $Day2Solution = new Day6Solution();

        $this->assertSame((string) $expected, $Day2Solution->solve($input));
    }

    /**
     * @dataProvider inputMessageDataProvider
     */
    public function testSecondPart(string $input, int $expected): void
    {
        $Day2Solution = new Day6Solution();

        $this->assertSame((string) $expected, $Day2Solution->solveSecondPart($input));
    }

    /**
     * @return array{string, positive-int}[]
     */
    public function inputDataProvider(): array
    {
        return [
            ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', 7],
            ['bvwbjplbgvbhsrlpgdmjqwftvncz', 5],
            ['nppdvjthqldpwncqszvftbrmjlhg', 6],
            ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 10],
            ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 11],
        ];
    }

    /**
     * @return array{string, positive-int}[]
     */
    public function inputMessageDataProvider(): array
    {
        return [
            ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', 19],
            ['bvwbjplbgvbhsrlpgdmjqwftvncz', 23],
            ['nppdvjthqldpwncqszvftbrmjlhg', 23],
            ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 29],
            ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 26],
        ];
    }
}
