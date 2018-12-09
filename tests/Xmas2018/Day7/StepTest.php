<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day7;

use Jean85\AdventOfCode\Xmas2018\Day7\Step;
use PHPUnit\Framework\TestCase;

class StepTest extends TestCase
{
    /**
     * @dataProvider costDataProvider
     */
    public function testGetCost(string $name, int $cost): void
    {
        $step = new Step($name);

        $this->assertSame($cost, $step->getCost());
    }

    public function costDataProvider(): array
    {
        return [
            ['A', 1],
            ['B', 2],
            ['C', 3],
            ['D', 4],
            ['E', 5],
            ['F', 6],
            ['Z', 26],
        ];
    }
}
