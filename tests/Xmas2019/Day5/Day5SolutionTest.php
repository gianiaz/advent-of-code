<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day5;

use Jean85\AdventOfCode\Xmas2019\Day5\Day5Solution;
use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;
use PHPUnit\Framework\TestCase;

class Day5SolutionTest extends TestCase
{
    public function testIO(): void
    {
        $input = random_int(1, 1000);
        $memory = new MemoryWithIO([3, 0, 4, 0, 99]);
        $memory->setInput($input);
        $solution = new Day5Solution();

        $solution->run($memory);

        $this->assertSame($input, $memory->getOutput());
    }

    public function testParameterModes(): void
    {
        $memory = new MemoryWithIO([1002, 4, 3, 4, 33]);
        $solution = new Day5Solution();

        $solution->run($memory);

        $this->assertSame([1002, 4, 3, 4, 99], $memory->getMemory());
    }

    public function testWithNegatives(): void
    {
        $memory = new MemoryWithIO([1101, 100, -1, 4, 0]);
        $solution = new Day5Solution();

        $solution->run($memory);

        $this->assertSame([1101, 100, -1, 4, 99], $memory->getMemory());
    }

    /**
     * @dataProvider jumpsMemoryDataProvider
     */
    public function testReturnsTrueWithJumps(array $memory, int $correctValue): void
    {
        $memory = new MemoryWithIO($memory);
        $solution = new Day5Solution();
        $memory->setInput($correctValue);

        $solution->run($memory);

        $this->assertSame(1, $memory->getOutput());
    }

    /**
     * @dataProvider jumpsMemoryDataProvider
     */
    public function testReturnsFalseWithJumps(array $memory): void
    {
        $memory = new MemoryWithIO($memory);
        $solution = new Day5Solution();
        $memory->setInput(9);

        $solution->run($memory);

        $this->assertSame(0, $memory->getOutput());
    }

    public function jumpsMemoryDataProvider(): array
    {
        return [
            [[3, 9, 8, 9, 10, 9, 4, 9, 99, -1, 8], 8],
            [[3, 9, 7, 9, 10, 9, 4, 9, 99, -1, 8], 7],
            [[3, 3, 1108, -1, 8, 3, 4, 3, 99], 8],
            [[3, 3, 1107, -1, 8, 3, 4, 3, 99], 7],
        ];
    }

    /**
     * @dataProvider notZeroMemoryDataProvider
     */
    public function testReturnsIfZero(array $memory): void
    {
        $memory = new MemoryWithIO($memory);
        $solution = new Day5Solution();
        $memory->setInput(0);

        $solution->run($memory);

        $this->assertSame(0, $memory->getOutput());
    }

    /**
     * @dataProvider notZeroMemoryDataProvider
     */
    public function testReturnsIfNotZero(array $memory): void
    {
        $memory = new MemoryWithIO($memory);
        $solution = new Day5Solution();
        $memory->setInput(9999);

        $solution->run($memory);

        $this->assertSame(1, $memory->getOutput());
    }

    public function notZeroMemoryDataProvider(): array
    {
        return [
            [[3, 12, 6, 12, 15, 1, 13, 14, 13, 4, 13, 99, -1, 0, 1, 9]],
            [[3, 3, 1105, -1, 9, 1101, 0, 0, 12, 4, 12, 99, 1]],
        ];
    }

    /**
     * @dataProvider largeExampleDataProvider
     */
    public function testLargeExample(int $expected, int $input): void
    {
        $memory = new MemoryWithIO([3, 21, 1008, 21, 8, 20, 1005, 20, 22, 107, 8, 21, 20, 1006, 20, 31, 1106, 0, 36, 98, 0, 0, 1002, 21, 125, 20, 4, 20, 1105, 1, 46, 104, 999, 1105, 1, 46, 1101, 1000, 1, 20, 4, 20, 1105, 1, 46, 98, 99]);
        $solution = new Day5Solution();
        $memory->setInput($input);

        $solution->run($memory);

        $this->assertSame($expected, $memory->getOutput());
    }

    public function largeExampleDataProvider()
    {
        return [
            [999, 7],
            [1000, 8],
            [1001, 9],
        ];
    }
}
