<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day7;

use Jean85\AdventOfCode\Xmas2020\Day7\RuleHandler;
use PHPUnit\Framework\TestCase;

class RuleHandlerTest extends TestCase
{
    public function testMayContain(): void
    {
        $ruleHandler = new RuleHandler($this->getFirstInput());

        $this->assertCount(4, $ruleHandler->whichColorsMayContain('shiny gold'));
    }

    /**
     * @dataProvider containedRulesProvider
     */
    public function testAreContained(int $expected, string $input, string $startColor = 'shiny gold'): void
    {
        $ruleHandler = new RuleHandler($input);

        $this->assertSame($expected, $ruleHandler->countColorsContainedInto($startColor));
    }

    /**
     * @return array{0: int, 1: string}[]
     */
    public function containedRulesProvider(): array
    {
        return [
            [0, $this->getFirstInput(), 'faded blue'],
            [0, $this->getFirstInput(), 'dotted black'],
            [11, $this->getFirstInput(), 'vibrant plum'],
            [7, $this->getFirstInput(), 'dark olive'],
            [32, $this->getFirstInput()],
            [126, $this->getSecondInput()],
        ];
    }

    private function getFirstInput(): string
    {
        return 'light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.';
    }

    private function getSecondInput(): string
    {
        return 'shiny gold bags contain 2 dark red bags.
dark red bags contain 2 dark orange bags.
dark orange bags contain 2 dark yellow bags.
dark yellow bags contain 2 dark green bags.
dark green bags contain 2 dark blue bags.
dark blue bags contain 2 dark violet bags.
dark violet bags contain no other bags.';
    }
}
