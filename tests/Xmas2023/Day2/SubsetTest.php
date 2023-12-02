<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day2;

use Jean85\AdventOfCode\Xmas2023\Day2\Subset;
use PHPUnit\Framework\TestCase;

class SubsetTest extends TestCase
{
    public function testParse(): void
    {
        $subset = Subset::parse(' 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $this->assertSame(6, $subset->blue, 'Blue does not match');
        $this->assertSame(4, $subset->red, 'Red does not match');
        $this->assertSame(2, $subset->green, 'Green does not match');
    }
}
