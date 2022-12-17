<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day17;

use Jean85\AdventOfCode\Xmas2022\Day17\JetStream;
use Jean85\AdventOfCode\Xmas2022\Day17\JetStreamGenerator;
use PHPUnit\Framework\TestCase;

class JetStreamGeneratorTest extends TestCase
{
    public function test(): void
    {
        $jetStreamGenerator = new JetStreamGenerator('<><<');

        $this->assertEquals(JetStream::Left, $jetStreamGenerator->next());
        $this->assertEquals(JetStream::Right, $jetStreamGenerator->next());
        $this->assertEquals(JetStream::Left, $jetStreamGenerator->next());
        $this->assertEquals(JetStream::Left, $jetStreamGenerator->next());
    }
}
