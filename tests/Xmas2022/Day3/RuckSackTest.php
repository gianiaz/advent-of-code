<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day3;

use Jean85\AdventOfCode\Xmas2022\Day3\RuckSack;
use PHPUnit\Framework\TestCase;

class RuckSackTest extends TestCase
{
    /**
     * @dataProvider ruckSackDataProvider
     */
    public function testGetCorrectSplit(string $input, string $expectedFirst, string $expectedSecond): void
    {
        $this->assertSame(strlen($expectedFirst), strlen($expectedSecond));

        $ruckSack = new RuckSack($input);

        $this->assertSame(strlen($input), strlen($ruckSack->firstCompartment . $ruckSack->secondCompartment));
        $this->assertSame($expectedFirst, $ruckSack->firstCompartment);
        $this->assertSame($expectedSecond, $ruckSack->secondCompartment);
    }

    /**
     * @dataProvider ruckSackDataProvider
     */
    public function testGetPriority(string $input, string $expectedFirst, string $expectedSecond, string $expectedShared, int $expectedPriority): void
    {
        $ruckSack = new RuckSack($input);

        $this->assertSame($expectedPriority, $ruckSack->getPriority());
    }

    public function ruckSackDataProvider(): array
    {
        return [
            ['vJrwpWtwJgWrhcsFMMfFFhFp', 'vJrwpWtwJgWr', 'hcsFMMfFFhFp', 'p', 16],
            ['jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL', 'jqHRNqRjqzjGDLGL', 'rsFMfFZSrLrFZsSL', 'L', 38],
            ['PmmdzqPrVvPwwTWBwg', 'PmmdzqPrV', 'vPwwTWBwg', 'P', 42],
            ['wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn', 'wMqvLMZHhHMvwLH', 'jbvcjnnSBnvTQFn', 'v', 22],
            ['ttgJtRGJQctTZtZT', 'ttgJtRGJ', 'QctTZtZT', 't', 20],
            ['CrZsJsPPZsGzwwsLwLmpwMDw', 'CrZsJsPPZsGz', 'wwsLwLmpwMDw', 's', 19],
        ];
    }
}
