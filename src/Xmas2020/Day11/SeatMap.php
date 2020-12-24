<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day11;

abstract class SeatMap
{
    public const EMPTY = 'L';
    public const OCCUPIED = '#';
    public const FLOOR = '.';

    /** @var string[][] */
    protected array $seatMap = [];
    protected int $maxRows = 0;
    protected int $maxSeats = 0;

    public static function init(string $input): self
    {
        $new = new static();

        $row = 0;
        foreach (explode("\n", $input) as $rows) {
            $seat = 0;
            ++$new->maxRows;
            $new->maxSeats = max($new->maxSeats, strlen($rows));
            foreach (str_split($rows) as $cell) {
                switch ($cell) {
                    case self::EMPTY:
                    case self::OCCUPIED:
                        $new->seatMap[$row][$seat] = $cell;
                        break;
                    case self::FLOOR:
                        // noop
                        break;
                }
                ++$seat;
            }
            ++$row;
        }

        return $new;
    }

    public function print(): string
    {
        $string = '';

        foreach (range(0, $this->maxRows - 1) as $row) {
            foreach (range(0, $this->maxSeats - 1) as $seat) {
                $string .= $this->seatMap[$row][$seat] ?? self::FLOOR;
            }

            $string .= PHP_EOL;
        }

        return trim($string);
    }

    public function countOccupiedSeats(): int
    {
        $count = 0;

        foreach ($this->seatMap as $row) {
            foreach ($row as $seat) {
                if ($seat === self::OCCUPIED) {
                    ++$count;
                }
            }
        }

        return $count;
    }

    public function tick(): bool
    {
        $newArrangement = $this->seatMap;
        $changed = false;

        foreach ($this->seatMap as $row => $rowList) {
            foreach ($rowList as $seat => $currentSeatStatus) {
                $surroundingOccupiedSeats = $this->countSurroundingOccupiedSeats($row, $seat);

                if ($currentSeatStatus === self::EMPTY && $surroundingOccupiedSeats === 0) {
                    $newArrangement[$row][$seat] = self::OCCUPIED;
                    $changed = true;
                } elseif ($currentSeatStatus === self::OCCUPIED && $surroundingOccupiedSeats >= static::getSurroundingOccupiedLimit()) {
                    $newArrangement[$row][$seat] = self::EMPTY;
                    $changed = true;
                }
            }
        }

        $this->seatMap = $newArrangement;

        return $changed;
    }

    abstract protected function countSurroundingOccupiedSeats(int $row, int $seat): int;

    abstract protected static function getSurroundingOccupiedLimit(): int;
}
