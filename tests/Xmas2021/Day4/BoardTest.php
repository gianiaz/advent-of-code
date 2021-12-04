<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day4;

use Jean85\AdventOfCode\Xmas2021\Day4\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    private const TEST_INPUT =
        '22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19';

    public function testConstruction(): void
    {
        $input = self::TEST_INPUT;

        $board = new Board($input);

        $expected = [
            [22, 13, 17, 11, 0],
            [8, 2, 23, 4, 24],
            [21, 9, 14, 16, 7],
            [6, 10, 3, 18, 5],
            [1, 12, 20, 15, 19],
        ];
        $this->assertEquals($expected, $board->getBoard());
    }

    /**
     * @dataProvider sequenceDataProvider
     *
     * @param int[] $sequence
     */
    public function testExtractions(array $sequence): void
    {
        $board = new Board(self::TEST_INPUT);

        foreach ($sequence as $number) {
            $this->assertFalse($board->isWinning());
            $board->extract($number);
        }

        $this->assertTrue($board->isWinning());
    }

    public function sequenceDataProvider(): array
    {
        return [
            [[22, 13, 17, 11, 0]],
        ];
    }
}
