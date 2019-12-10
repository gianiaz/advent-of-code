<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day10;

use Jean85\AdventOfCode\Xmas2019\Day10\AsteroidMap;
use Jean85\AdventOfCode\Xmas2019\Day10\LineOfSight;
use PHPUnit\Framework\TestCase;

class LineOfSightTest extends TestCase
{
    /**
     * @dataProvider firstSolutionProvider
     */
    public function testIsVisibleFromFirstExample(int $x, int $y, bool $isVisible = true): void
    {
        $input = '
.#..#
.....
#####
....#
...##
';

        $map = new AsteroidMap($input);
        $line = new LineOfSight($map);

        $this->assertSame($isVisible, $line->isVisible(3, 4, $x, $y));
    }

    public function firstSolutionProvider(): array
    {
        return [
            [4, 0],
            [0, 2],
            [1, 2],
            [2, 2],
            [3, 2],
            [4, 2],
            [4, 3],
            [4, 4],
            [1, 0, false],
        ];
    }
}
