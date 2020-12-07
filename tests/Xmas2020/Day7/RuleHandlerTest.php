<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day7;

use Jean85\AdventOfCode\Xmas2020\Day7\RuleHandler;
use PHPUnit\Framework\TestCase;

class RuleHandlerTest extends TestCase
{
    public function test(): void
    {
        $input = 'light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.';
        $ruleHandler = new RuleHandler($input);

        $this->assertCount(4, $ruleHandler->whichColorsMayContain('shiny gold'));
    }
}
