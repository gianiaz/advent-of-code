<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day9;

use Jean85\AdventOfCode\Xmas2019\Day9\Day9Solution;
use Jean85\AdventOfCode\Xmas2019\Day9\MemoryWithRelativeMode;
use PHPUnit\Framework\TestCase;

class AdjustRelativeBaseTest extends TestCase
{
    public function testApply(): void
    {
        $input = [109, 19, 204, -34, 99];
        $input[1985] = 1985;
        $memory = new MemoryWithRelativeMode($input);
        $memory->alterRelative(2000);

        $computer = (new Day9Solution())->creatComputer();
        $computer->run($memory);

        $this->assertSame(1985, $memory->getOutput());
    }

    public function testQuineWithVoidOffsets(): void
    {
        $quine = [109, 1, 204, -1, 1001, 100, 1, 100, 1008, 100, 16, 101, 1006, 101, 0, 99];
        $memory = new MemoryWithRelativeMode($quine);

        $computer = (new Day9Solution())->creatComputer();
        $computer->run($memory);

        $this->assertSame($quine, $memory->getAllOutput());
    }

    public function testWithLongOutput(): void
    {
        $memory = new MemoryWithRelativeMode([1102, 34915192, 34915192, 7, 4, 7, 99, 0]);

        $computer = (new Day9Solution())->creatComputer();
        $computer->run($memory);

        $this->assertSame(16, strlen((string) $memory->getOutput()));
    }

    public function testWithLargeInput(): void
    {
        $memory = new MemoryWithRelativeMode([104, 1125899906842624, 99]);

        $this->runWithDay9Computer($memory);

        $output = $memory->getOutput();
        $this->assertSame(1125899906842624, $output);
        $this->assertSame('1125899906842624', (string) $output);
    }

    public function testMultiplyRelativeMode(): void
    {
        $input = [1202, 11, 12, 13, 99];
        $input[99] = 10;
        $memory = new MemoryWithRelativeMode($input);
        $memory->alterRelative(88);

        $this->runWithDay9Computer($memory);

        $this->assertSame(10 * 12, $memory->get(13));
    }

    public function testAddRelativeMode(): void
    {
        $input = [21001, 11, 12, 13, 99];
        $input[11] = 10;
        $memory = new MemoryWithRelativeMode($input);
        $memory->alterRelative(10);

        $this->runWithDay9Computer($memory);

        $this->assertSame(10 + 12, $memory->get(23));
    }

    private function runWithDay9Computer(MemoryWithRelativeMode $memory): void
    {
        $solution = new Day9Solution();
        $computer = $solution->creatComputer();

        $computer->run($memory);
    }
}
