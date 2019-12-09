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
}
