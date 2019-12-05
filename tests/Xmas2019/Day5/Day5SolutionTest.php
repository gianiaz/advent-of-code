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
}
