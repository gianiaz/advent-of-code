<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day7;

use Jean85\AdventOfCode\Xmas2019\Day7\Combinator;
use PHPUnit\Framework\TestCase;

class CombinatorTest extends TestCase
{
    public function test(): void
    {
        $expected = [
            [1, 2],
            [2, 1],
        ];

        $this->assertSame($expected, iterator_to_array(Combinator::generateCombinations([1, 2])));
    }
}
