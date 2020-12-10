<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day9;

use Jean85\AdventOfCode\Xmas2020\Day9\XMASDecoder;
use PHPUnit\Framework\TestCase;

class XMASDecoderTest extends TestCase
{
    public function testFindFirstNumberOutsideRule(): void
    {
        $input = $this->getInput();
        $decoder = new XMASDecoder($input);

        $this->assertSame(127, $decoder->findFirstNumberOutsideRule(5));
    }

    public function testFindEncryptionWeakness(): void
    {
        $input = $this->getInput();
        $decoder = new XMASDecoder($input);

        $this->assertSame(62, $decoder->findEncryptionWeakness(5));
    }

    private function getInput(): string
    {
        return '35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576';
    }
}
