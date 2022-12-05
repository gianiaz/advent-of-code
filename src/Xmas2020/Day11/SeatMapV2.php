<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day11;

class SeatMapV2 extends SeatMap
{
    protected function countSurroundingOccupiedSeats(int $row, int $seat): int
    {
        return $this->countAsOccupiedInSight($row, -1, $seat, -1)
             + $this->countAsOccupiedInSight($row, -1, $seat, 0)
             + $this->countAsOccupiedInSight($row, -1, $seat, +1)
             + $this->countAsOccupiedInSight($row, 0, $seat, -1)
             + $this->countAsOccupiedInSight($row, 0, $seat, +1)
             + $this->countAsOccupiedInSight($row, +1, $seat, -1)
             + $this->countAsOccupiedInSight($row, +1, $seat, 0)
             + $this->countAsOccupiedInSight($row, +1, $seat, +1)
        ;
    }

    private function countAsOccupiedInSight(int $row, int $rowAdd, int $seat, int $seatAdd): int
    {
        do {
            $row += $rowAdd;
            $seat += $seatAdd;

            if ($row < 0 || $seat < 0) {
                return 0;
            }

            switch ($this->seatMap[$row][$seat] ?? self::FLOOR) {
                case self::EMPTY:
                    return 0;
                case self::OCCUPIED:
                    return 1;
            }
        } while (
            $row <= $this->maxRows
            && $seat <= $this->maxSeats
        );

        return 0;
    }

    protected static function getSurroundingOccupiedLimit(): int
    {
        return 5;
    }
}
