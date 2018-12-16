<?php

namespace Tests\Xmas2018\Day13;

use Jean85\AdventOfCode\Xmas2018\Day13\Tracks;
use PHPUnit\Framework\TestCase;

class TracksTest extends TestCase
{
    public function testGetActualSituation(): void
    {
        $tracks = new Tracks($this->getExampleTracks());
        
        $this->assertSame($this->getExampleTracks(), $tracks->getActualSituation());
        $this->assertCount(2, $tracks->getCarts());
    }

    private function getExampleTracks(): string
    {
        return
            '/->-\
|   |  /----\
| /-+--+-\  |
| | |  | v  |
\-+-/  \-+--/
  \------/';
    }
}
