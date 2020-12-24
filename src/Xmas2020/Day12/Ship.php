<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day12;

class Ship
{
    private int $east = 0;
    private int $north = 0;
    private int $currentDirection = 0;

    private const DIRECTIONS = [
        ['x' => 1, 'y' => 0], // east
        ['x' => 0, 'y' => -1], // south
        ['x' => -1, 'y' => 0], // west
        ['x' => 0, 'y' => +1], // north
    ];

    public function getEast(): int
    {
        return $this->east;
    }

    public function getNorth(): int
    {
        return $this->north;
    }

    public function getCurrentDirection(): int
    {
        return $this->currentDirection;
    }

    public function move(string $action, int $value): void
    {
        switch ($action) {
            case 'N':
                $this->north += $value;
                break;
            case 'S':
                $this->north -= $value;
                break;
            case 'E':
                $this->east += $value;
                break;
            case 'W':
                $this->east -= $value;
                break;
            case 'F':
                $this->east += $value * self::DIRECTIONS[$this->currentDirection]['x'];
                $this->north += $value * self::DIRECTIONS[$this->currentDirection]['y'];
                break;
            case 'R':
                $this->rotate($value);
                break;
            case 'L':
                $this->rotate(-$value);
                break;
            default:
                throw new \InvalidArgumentException('Unrecognized action: ' . $action);
        }
    }

    private function rotate(int $value): void
    {
        if ($value % 90) {
            throw new \InvalidArgumentException('Strange rotation value: ' . $value);
        }

        $this->currentDirection += (int) ($value / 90);
        $this->currentDirection += 4;
        $this->currentDirection %= 4;
    }
}
