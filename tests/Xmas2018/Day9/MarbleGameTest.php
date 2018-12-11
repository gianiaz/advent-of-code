<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day9;

use Jean85\AdventOfCode\Xmas2018\Day9\MarbleGame;
use PHPUnit\Framework\TestCase;

class MarbleGameTest extends TestCase
{
    public function testPlayWithDebug(): void
    {
        $game = new MarbleGame(9, 25);
        $game->enableDebug();
        $expectedDebugTrace = [
            '[0]  0<',
            '[1]  0  1<',
            '[2]  0  2< 1 ',
            '[3]  0  2  1  3<',
            '[4]  0  4< 2  1  3 ',
            '[5]  0  4  2  5< 1  3 ',
            '[6]  0  4  2  5  1  6< 3 ',
            '[7]  0  4  2  5  1  6  3  7<',
            '[8]  0  8< 4  2  5  1  6  3  7 ',
            '[9]  0  8  4  9< 2  5  1  6  3  7 ',
            '[1]  0  8  4  9  2 10< 5  1  6  3  7 ',
            '[2]  0  8  4  9  2 10  5 11< 1  6  3  7 ',
            '[3]  0  8  4  9  2 10  5 11  1 12< 6  3  7 ',
            '[4]  0  8  4  9  2 10  5 11  1 12  6 13< 3  7 ',
            '[5]  0  8  4  9  2 10  5 11  1 12  6 13  3 14< 7 ',
            '[6]  0  8  4  9  2 10  5 11  1 12  6 13  3 14  7 15<',
            '[7]  0 16< 8  4  9  2 10  5 11  1 12  6 13  3 14  7 15 ',
            '[8]  0 16  8 17< 4  9  2 10  5 11  1 12  6 13  3 14  7 15 ',
            '[9]  0 16  8 17  4 18< 9  2 10  5 11  1 12  6 13  3 14  7 15 ',
            '[1]  0 16  8 17  4 18  9 19< 2 10  5 11  1 12  6 13  3 14  7 15 ',
            '[2]  0 16  8 17  4 18  9 19  2 20<10  5 11  1 12  6 13  3 14  7 15 ',
            '[3]  0 16  8 17  4 18  9 19  2 20 10 21< 5 11  1 12  6 13  3 14  7 15 ',
            '[4]  0 16  8 17  4 18  9 19  2 20 10 21  5 22<11  1 12  6 13  3 14  7 15 ',
            '[5]  0 16  8 17  4 18 19< 2 20 10 21  5 22 11  1 12  6 13  3 14  7 15 ',
            '[6]  0 16  8 17  4 18 19  2 24<20 10 21  5 22 11  1 12  6 13  3 14  7 15 ',
            '[7]  0 16  8 17  4 18 19  2 24 20 25<10 21  5 22 11  1 12  6 13  3 14  7 15 ',
        ];

        $game->play();

        $this->assertSame($expectedDebugTrace, $game->getDebugTrace());
    }

    /**
     * @dataProvider playDataProvider
     */
    public function testPlay(int $players, int $lastMarble, int $expectedBestScore): void
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
        ];
    }
}
