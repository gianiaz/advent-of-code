<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day20;

use Jean85\AdventOfCode\Xmas2018\Day20\Construction;
use PHPUnit\Framework\TestCase;

class ConstructionTest extends TestCase
{
    /**
     * @dataProvider processPathsProvider
     */
    public function testProcessPaths(string $instructions, array $expectedPossiblePaths, string $expectedMap): void
    {
        $construction = new Construction($instructions);

        $construction->processPaths();

        $possiblePaths = $construction->getPossiblePaths();
        foreach ($expectedPossiblePaths as $expected) {
            $this->assertContains($expected, $possiblePaths, print_r($possiblePaths, true));
        }
//        $this->assertSame($expectedMap, \trim($construction->getTextualMap()), $construction->getTextualMap());
    }

    public function processPathsProvider(): array
    {
        return [
            'linear' => [
                '^WNE$',
                ['WNE'],
                '#####
#.|.#
#-###
#.|X#
#####',
            ],
            'simple branching' => [
                '^W(N|E)$',
                [
                    'WN',
                    'WE',
                ],
                '',
            ],
            'recursive branching' => [
                '^ENWWW(NEEE|SSE(EE|N))$',
                [
                    'ENWWWNEEE',
                    'ENWWWSSEEE',
                    'ENWWWSSEN',
                ],
                '#########
#.|.|.|.#
#-#######
#.|.|.|.#
#-#####-#
#.#.#X|.#
#-#-#####
#.|.|.|.#
#########',
            ],
        ];
    }
}
