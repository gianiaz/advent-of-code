<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day4;

class Board
{
    private const X = 'X';
    /** @var (self::X|int)[][] */
    private array $board = [];
    private bool $winning = false;

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, $input) as $i => $row) {
            $cleanRow = preg_replace('/ +/', ' ', trim($row));
            foreach (explode(' ', $cleanRow) as $j => $number) {
                $this->board[$i][$j] = (int) $number;
            }
        }
    }

    /**
     * @return (string|int)[][]
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    public function isWinning(): bool
    {
        return $this->winning;
    }

    public function extract(int $number): void
    {
        if ($this->winning) {
            return;
        }

        foreach ($this->board as $x => $row) {
            foreach ($row as $y => $value) {
                if ($value === $number) {
                    $this->board[$x][$y] = self::X;
                    $this->checkBingo($x, $y);

                    return;
                }
            }
        }
    }

    public function sumAllRemainingNumbers(): int
    {
        $total = 0;

        foreach ($this->board as $row) {
            foreach ($row as $item) {
                if ($item !== self::X) {
                    $total += (int) $item;
                }
            }
        }

        return $total;
    }

    private function checkBingo(int $x, int $y): void
    {
        if ($this->winning) {
            return;
        }

        $bingoInRow = true;
        $bingoInColumn = true;

        foreach (range(0, count($this->board) - 1) as $i) {
            $bingoInRow = $bingoInRow && $this->board[$i][$y] === self::X;
            $bingoInColumn = $bingoInColumn && $this->board[$x][$i] === self::X;
        }

        $this->winning = $bingoInRow || $bingoInColumn;
    }
}
