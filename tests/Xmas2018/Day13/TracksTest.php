<?php

declare(strict_types=1);

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

    public function testTick(): void
    {
        $tracks = new Tracks($this->getExampleTracks());

        $this->assertSame($this->getExampleTracks(), $tracks->getActualSituation());

        foreach ($this->getExampleSequence() as $situation) {
            $tracks->tick();
            $this->assertSame($situation, $tracks->getActualSituation());
        }
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

    private function getExampleSequence(): array
    {
        return [
            '/-->\
|   |  /----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \->--/
  \------/',

            '/---v
|   |  /----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \-+>-/
  \------/',

            '/---\
|   v  /----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \-+->/
  \------/',

            '/---\
|   |  /----\
| /->--+-\  |
| | |  | |  |
\-+-/  \-+--^
  \------/',

            '/---\
|   |  /----\
| /-+>-+-\  |
| | |  | |  ^
\-+-/  \-+--/
  \------/',

            '/---\
|   |  /----\
| /-+->+-\  ^
| | |  | |  |
\-+-/  \-+--/
  \------/',

            '/---\
|   |  /----<
| /-+-->-\  |
| | |  | |  |
\-+-/  \-+--/
  \------/',

            '/---\
|   |  /---<\
| /-+--+>\  |
| | |  | |  |
\-+-/  \-+--/
  \------/',

            '/---\
|   |  /--<-\
| /-+--+-v  |
| | |  | |  |
\-+-/  \-+--/
  \------/',

            '/---\
|   |  /-<--\
| /-+--+-\  |
| | |  | v  |
\-+-/  \-+--/
  \------/',

            '/---\
|   |  /<---\
| /-+--+-\  |
| | |  | |  |
\-+-/  \-<--/
  \------/',

            '/---\
|   |  v----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \<+--/
  \------/',

            '/---\
|   |  /----\
| /-+--v-\  |
| | |  | |  |
\-+-/  ^-+--/
  \------/',

            '/---\
|   |  /----\
| /-+--+-\  |
| | |  X |  |
\-+-/  \-+--/
  \------/',
        ];
    }
}
