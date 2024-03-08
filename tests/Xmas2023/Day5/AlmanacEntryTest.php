<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day5;

use Jean85\AdventOfCode\Xmas2022\Day5\AlmanacEntry;
use PHPUnit\Framework\TestCase;

class AlmanacEntryTest extends TestCase
{
    public function testParse(): void
    {
        $input = 'seed-to-soil map:
50 98 2
52 50 48
';

        $entry = AlmanacEntry::parse($input);

        $this->assertSame('seed', $entry->from);
        $this->assertSame('soil', $entry->to);
        $this->assertSame(49, $entry->convert(49));
        $this->assertSame(50, $entry->convert(98));
        $this->assertSame(51, $entry->convert(99));
        $this->assertSame(81, $entry->convert(79));
        $this->assertSame(14, $entry->convert(14));
        $this->assertSame(57, $entry->convert(55));
        $this->assertSame(13, $entry->convert(13));
    }
}
