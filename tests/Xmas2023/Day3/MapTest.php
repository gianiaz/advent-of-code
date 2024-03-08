<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day3;

use Jean85\AdventOfCode\Xmas2022\Day3\Map;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function testGetNumbers(): void
    {
        $input = '467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..
';

        $map = Map::parse($input);
        $numbers = $map->getNumbers();

        $this->assertNotContains(114, $numbers);
        $this->assertNotContains(58, $numbers);
        $this->assertNotEmpty($numbers, 'No numbers found');
        $this->assertContains(467, $numbers);
        $this->assertContains(35, $numbers);
        $this->assertContains(633, $numbers);
        $this->assertContains(617, $numbers);
        $this->assertContains(592, $numbers);
        $this->assertContains(755, $numbers);
        $this->assertContains(664, $numbers);
        $this->assertContains(598, $numbers);
    }
}
