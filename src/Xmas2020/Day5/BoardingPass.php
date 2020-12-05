<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day5;

class BoardingPass
{
    private int $row;
    private int $column;

    public function __construct(string $input)
    {
        $this->row = $this->calculateRow($input);
        $this->column = $this->calculateColumn($input);
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    private function calculateRow(string $input): int
    {
        $rowPart = substr($input, 0, 7);
        $binary = '0b' . str_replace(['F', 'B'], [0, 1], $rowPart);

        return bindec($binary);
    }

    private function calculateColumn(string $input): int
    {
        $rowPart = substr($input, -3);
        $binary = '0b' . str_replace(['L', 'R'], [0, 1], $rowPart);

        return bindec($binary);
    }

    public function getId(): int
    {
        return $this->row * 8 + $this->column;
    }
}
