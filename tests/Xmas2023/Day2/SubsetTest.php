<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day2;

use Jean85\AdventOfCode\Xmas2023\Day2\Subset;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SubsetTest extends TestCase
{
    public function testParse(): void
    {
        $subset = Subset::parse(' 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $this->assertSame(6, $subset->blue, 'Blue does not match');
        $this->assertSame(4, $subset->red, 'Red does not match');
        $this->assertSame(2, $subset->green, 'Green does not match');
    }

    #[DataProvider('powerDataProvider')]
    public function testGetPower(int $power, string $input): void
    {
        $this->assertSame($power, Subset::parse($input)->getPower());
    }

    /**
     * @return array{int, non-empty-string}[]
     */
    public static function powerDataProvider(): array
    {
        return [
            [48, '3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green'],
            [12, '1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue'],
            [1560, '8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red'],
            [630, '1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red'],
            [36, '6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green'],
        ];
    }
}
