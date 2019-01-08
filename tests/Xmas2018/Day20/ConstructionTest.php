<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day20;

use Jean85\AdventOfCode\Xmas2018\Day20\Construction;
use PHPUnit\Framework\TestCase;

class ConstructionTest extends TestCase
{
    /**
     * @dataProvider ProcessPathsProvider
     */
    public function testProcessPaths(string $instructions, array $expectedPossiblePaths): void
    {
        $construction = new Construction($instructions);

        $construction->processPaths();

        $possiblePaths = $construction->getPossiblePaths();
        foreach ($expectedPossiblePaths as $expected) {
            $this->assertContains($expected, $possiblePaths, print_r($possiblePaths, true));
        }
    }

    public function processPathsProvider(): array
    {
        return [
            'linear' => [
                '^WNE$',
                ['WNE'],
            ],
            'simple branching' => [
                '^W(N|E)$',
                [
                    'WN',
                    'WE',
                ],
            ],
            'recursive branching' => [
                '^A(B|C(D|E))F$',
                [
                    'ABF',
                    'ACDF',
                    'ACEF',
                ],
            ],
            'empty branches' => [
                '^A(B|)C(D|)E$',
                [
                    'ACE',
                    'ACDE',
                    'ABCE',
                    'ABCDE',
                ],
            ],
            'complex empty branches from example' => [
                '^ENNWSWW(NEWS|)SSSEEN(WNSE|)EE(SWEN|)NNN$',
                [
                    'ENNWSWWSSSEENEENNN',
                    'ENNWSWWNEWSSSSEENEENNN',
                    'ENNWSWWNEWSSSSEENEESWENNNN',
                    'ENNWSWWSSSEENWNSEEENNN',
                ],
            ],
        ];
    }

    /**
     * @dataProvider fullProcessPathsProvider
     */
    public function testFullProcessPaths(string $instructions, array $expectedPossiblePaths, string $expectedMap): void
    {
        $construction = new Construction($instructions);

        $construction->processPaths();

        $possiblePaths = $construction->getPossiblePaths();
        foreach ($expectedPossiblePaths as $expected) {
            $this->assertContains($expected, $possiblePaths, print_r($possiblePaths, true));
        }
        $this->assertSame($expectedMap, \trim($construction->getTextualMap()), $construction->getTextualMap());
    }

    public function fullProcessPathsProvider(): array
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
                '#####
#.###
#-###
#.|X#
#####',
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
            'empty branches' => [
                '^ENNWSWW(NEWS|)SSSEEN(WNSE|)EE(SWEN|)NNN$',
                [
                    'ENNWSWWSSSEENEENNN',
                    'ENNWSWWNEWSSSSEENEENNN',
                    'ENNWSWWNEWSSSSEENEESWENNNN',
                    'ENNWSWWSSSEENWNSEEENNN',
                ],
                '###########
#.|.#.|.#.#
#-###-#-#-#
#.|.|.#.#.#
#-#####-#-#
#.#.#X|.#.#
#-#-#####-#
#.#.|.|.|.#
#-###-###-#
#.|.|.#.|.#
###########',
            ],
        ];
    }

    /**
     * @dataProvider getFurthestProvider
     */
    public function testGetFurthestRoom(string $instructions, string $expectedMap, int $expectedFurthest): void
    {
        $construction = new Construction($instructions);

        $construction->processPaths();

        $this->assertSame($expectedMap, \trim($construction->getTextualMap()), $construction->getTextualMap());
        $this->assertSame($expectedFurthest, $construction->getFurthestRoomDistance());
    }

    public function getFurthestProvider()
    {
        return [
            'first example' => [
                '^ESSWWN(E|NNENN(EESS(WNSE|)SSS|WWWSSSSE(SW|NNNE)))$',
                '#############
#.|.|.|.|.|.#
#-#####-###-#
#.#.|.#.#.#.#
#-#-###-#-#-#
#.#.#.|.#.|.#
#-#-#-#####-#
#.#.#.#X|.#.#
#-#-#-###-#-#
#.|.#.|.#.#.#
###-#-###-#-#
#.|.#.|.|.#.#
#############',
                23,
            ],
            [
                '^WSSEESWWWNW(S|NENNEEEENN(ESSSSW(NWSW|SSEN)|WSWWN(E|WWS(E|SS))))$',
                '###############
#.|.|.|.#.|.|.#
#-###-###-#-#-#
#.|.#.|.|.#.#.#
#-#########-#-#
#.#.|.|.|.|.#.#
#-#-#########-#
#.#.#.|X#.|.#.#
###-#-###-#-#-#
#.|.#.#.|.#.|.#
#-###-#####-###
#.|.#.|.|.#.#.#
#-#-#####-#-#-#
#.#.|.|.|.#.|.#
###############',
                31,
            ],
        ];
    }

}
