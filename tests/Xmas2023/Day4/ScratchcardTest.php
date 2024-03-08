<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day4;

use Jean85\AdventOfCode\Xmas2022\Day4\Scratchcard;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ScratchcardTest extends TestCase
{
    #[DataProvider('scratchcardsDataProvider')]
    public function testGetPoints(int $points, string $input): void
    {
        $scratchcard = Scratchcard::parse($input);

        $this->assertSame($points, $scratchcard->getPoints());
    }

    /**
     * @return array{int, non-empty-string}[]
     */
    public static function scratchcardsDataProvider(): array
    {
        return [
            'Card 1' => [8, '41 48 83 86 17 | 83 86  6 31 17  9 48 53'],
            'Card 2' => [2, '13 32 20 16 61 | 61 30 68 82 17 32 24 19'],
            'Card 3' => [2, ' 1 21 53 59 44 | 69 82 63 72 16 21 14  1'],
            'Card 4' => [1, '41 92 73 84 69 | 59 84 76 51 58  5 54 83'],
            'Card 5' => [0, '87 83 26 28 32 | 88 30 70 12 93 22 82 36'],
            'Card 6' => [0, '31 18 13 56 72 | 74 77 10 23 35 67 36 11'],
            'Card 3 with spaces' => [2, ' 1 21  53  59   44 | 69 82 63 72 16 21 14  1'],
        ];
    }
}
