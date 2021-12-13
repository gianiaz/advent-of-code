<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day13;

use Jean85\AdventOfCode\Xmas2021\Day13\FoldablePaper;
use PHPUnit\Framework\TestCase;

class FoldablePaperTest extends TestCase
{
    public function testGetMap(): void
    {
        $page = new FoldablePaper(
            '6,10
0,14
9,10
0,3
10,4
4,11
6,0
6,12
4,1
0,13
10,12
3,4
3,0
8,4
1,10
2,14
8,10
9,0'
        );

        $this->assertSame('...#..#..#.
....#......
...........
#..........
...#....#.#
...........
...........
...........
...........
...........
.#....#.##.
....#......
......#...#
#..........
#.#........', $page->getPaper());
    }
}
