<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day11;

class SeatMapV1 extends SeatMap
{
    protected function countSurroundingOccupiedSeats(int $row, int $seat): int
    {
        return $this->countAsOccupied($row - 1, $seat - 1)
            + $this->countAsOccupied($row - 1, $seat)
            + $this->countAsOccupied($row - 1, $seat + 1)
            + $this->countAsOccupied($row, $seat - 1)
            + $this->countAsOccupied($row, $seat + 1)
            + $this->countAsOccupied($row + 1, $seat - 1)
            + $this->countAsOccupied($row + 1, $seat)
            + $this->countAsOccupied($row + 1, $seat + 1)
            ;
    }

    private function countAsOccupied(int $row, int $seat): int
    {
        return (($this->seatMap[$row][$seat] ?? self::EMPTY) === self::OCCUPIED)
            ? 1
            : 0;
    }

    protected static function getSurroundingOccupiedLimit(): int
    {
        return 4;
    }
}
