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
    public function testReturnsTrueWithJumps(array $memory): void
    {
        $memory = new MemoryWithIO($memory);
        $solution = new Day5Solution();
        $memory->setInput(8);

        $solution->run($memory);

        $this->assertSame(1, $memory->getOutput());
    }

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
            [[3, 9, 8, 9, 10, 9, 4, 9, 99, -1, 8]],
            [[3, 9, 7, 9, 10, 9, 4, 9, 99, -1, 8]],
            [[3, 3, 1108, -1, 8, 3, 4, 3, 99]],
            [[3, 3, 1107, -1, 8, 3, 4, 3, 99]],
        ];
    }
}
