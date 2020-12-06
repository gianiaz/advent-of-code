<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day6;

use Jean85\AdventOfCode\Xmas2020\Day6\Day6Solution;
use PHPUnit\Framework\TestCase;

class Day6SolutionTest extends TestCase
{
    public function test(): void
    {
        $input = 'abc

a
b
c

ab
ac

a
a
a
a

b';

        $this->assertEquals(11, (new Day6Solution())->solve($input));
    }
}
