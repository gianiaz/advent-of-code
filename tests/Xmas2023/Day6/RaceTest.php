<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day6;

use Jean85\AdventOfCode\Xmas2022\Day6\Race;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    #[DataProvider('expectedWinningIntervalsDataProvider')]
    public function testWinningCombinationsGetters(int $time, int $distance, int $expectedFirst, int $expectedLast): void
    {
        $race = new Race($time, $distance);

        $this->assertSame($expectedFirst, $race->getFirstWinningCombination(), 'Wrong FIRST winning combination');
        $this->assertSame($expectedLast, $race->getLastWinningCombination(), 'Wrong LAST winning combination');
    }

    public static function expectedWinningIntervalsDataProvider(): array
    {
        return [
            //            [7, 9, 2, 5],
            [15, 40, 4, 11],
            [30, 200, 11, 19],
        ];
    }

    public function testGetWinningCombinationsCount(): void
    {
        $race = new Race(7, 9);

        $this->assertSame(4, $race->getWinningCombinationsCount());
    }
}
