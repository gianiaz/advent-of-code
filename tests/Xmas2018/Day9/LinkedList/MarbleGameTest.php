<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day9\LinkedList;

use Jean85\AdventOfCode\Xmas2018\Day9\LinkedList\MarbleGame;
use PHPUnit\Framework\TestCase;

class MarbleGameTest extends TestCase
{
    public function testPlayWithDebug(): void
    {
        $game = new MarbleGame(9, 25);
        $game->enableDebug();
        $expectedDebugTrace = [
            '[0] 0<',
            '[1] 0 1<',
            '[2] 1 0 2<',
            '[3] 0 2 1 3<',
            '[4] 2 1 3 0 4<',
            '[5] 1 3 0 4 2 5<',
            '[6] 3 0 4 2 5 1 6<',
            '[7] 0 4 2 5 1 6 3 7<',
            '[8] 4 2 5 1 6 3 7 0 8<',
            '[9] 2 5 1 6 3 7 0 8 4 9<',
            '[1] 5 1 6 3 7 0 8 4 9 2 10<',
            '[2] 1 6 3 7 0 8 4 9 2 10 5 11<',
            '[3] 6 3 7 0 8 4 9 2 10 5 11 1 12<',
            '[4] 3 7 0 8 4 9 2 10 5 11 1 12 6 13<',
            '[5] 7 0 8 4 9 2 10 5 11 1 12 6 13 3 14<',
            '[6] 0 8 4 9 2 10 5 11 1 12 6 13 3 14 7 15<',
            '[7] 8 4 9 2 10 5 11 1 12 6 13 3 14 7 15 0 16<',
            '[8] 4 9 2 10 5 11 1 12 6 13 3 14 7 15 0 16 8 17<',
            '[9] 9 2 10 5 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18<',
            '[1] 2 10 5 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 9 19<',
            '[2] 10 5 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 9 19 2 20<',
            '[3] 5 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 9 19 2 20 10 21<',
            '[4] 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 9 19 2 20 10 21 5 22<',
            '[5] 2 20 10 21 5 22 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 19<',
            '[6] 20 10 21 5 22 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 19 2 24<',
            '[7] 10 21 5 22 11 1 12 6 13 3 14 7 15 0 16 8 17 4 18 19 2 24 20 25<',
        ];

        $game->play();

        $this->assertSame($expectedDebugTrace, $game->getDebugTrace());
    }

    /**
     * @dataProvider playDataProvider
     */
    public function testPlayNoDebug(int $players, int $lastMarble, int $expectedBestScore): void
    {
        $game = new MarbleGame($players, $lastMarble);

        $this->assertSame($expectedBestScore, $game->play());
    }

    public function playDataProvider()
    {
        return [
            [9, 25, 32],
            [10, 1618, 8317],
            [13, 7999, 146373],
            [17, 1104, 2764],
            [21, 6111, 54718],
            [30, 5807, 37305],
            [418, 7133900, -1],
        ];
    }
}
