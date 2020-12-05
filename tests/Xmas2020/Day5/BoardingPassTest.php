<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day5;

use Jean85\AdventOfCode\Xmas2020\Day5\BoardingPass;
use PHPUnit\Framework\TestCase;

class BoardingPassTest extends TestCase
{
    /**
     * @dataProvider boardingPassInputDataProvider
     */
    public function test(string $input, int $row, int $column, int $id): void
    {
        $pass = new BoardingPass($input);

        $this->assertSame($row, $pass->getRow());
        $this->assertSame($column, $pass->getColumn());
        $this->assertSame($id, $pass->getId());
    }

    public function boardingPassInputDataProvider(): array
    {
        return [
            ['FBFBBFFRLR', 44, 5, 357],
            ['BFFFBBFRRR', 70, 7, 567],
            ['FFFBBBFRRR', 14, 7, 119],
            ['BBFFBBFRLL', 102, 4, 820],
        ];
    }
}
