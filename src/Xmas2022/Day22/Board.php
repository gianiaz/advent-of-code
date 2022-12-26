<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day22;

class Board
{
    /** @var list<positive-int|Turn> */
    private array $instructions= [];
    /** @var list<positive-int|Turn> */
    private array $currentInstructions;
    /** @var array<int, array<int, string>> */
    private array $map;
    private Direction $currentDirection;
    private int $x;
    private int $y;
    private int $maxX = 0;
    private int $maxY = 0;

    public function __construct(string $input)
    {
        [$map, $instructions] = explode(PHP_EOL . PHP_EOL, $input);
        $this->parseMap($map);
        $this->parseInstructions($instructions);

        $this->reset();
    }

    private function reset(): void
    {
        $this->currentDirection = Direction::Right;
        $this->currentInstructions = $this->instructions;
        $this->y = min(array_keys($this->map));
        $this->x = min(array_keys($this->map[$this->y]));
    }

    public function getPassword(): int
    {
        return 1000 * $this->y
            + 4 * $this->x
            + $this->currentDirection->value;
    }

    private function parseMap(string $input): void
    {
        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $tile) {
                if ($tile === ' ') {
                    continue;
                }

                $this->map[$y + 1][$x + 1] = $tile;
                $this->maxX = max($this->maxX, $x + 1);
                $this->maxY = max($this->maxY, $y + 1);
            }
        }
    }

    private function parseInstructions(string $input): void
    {
        $spacedInput = str_replace(['L', 'R'], [' L ', ' R '], $input);

        foreach (explode(' ', $spacedInput) as $instruction) {
            if (is_numeric($instruction)) {
                $this->instructions[] = (int) $instruction;
            } else {
                $this->instructions[] = Turn::from($instruction);
            }
        }
    }

    public function executeAllInstructions(): void
    {
        while (! empty($this->currentInstructions)) {
            $this->executeOneInstruction();
        }
    }

    public function executeOneInstruction(): void
    {
        if (empty($this->currentInstructions)) {
            throw new \RuntimeException('No more instructions');
        }

        $instruction = array_shift($this->currentInstructions);

        $this->drawCurrentPosition();

        if (is_int($instruction)) {
            $this->walkForward($instruction);
        } elseif ($instruction instanceof Turn) {
            $this->currentDirection = $this->currentDirection->turn($instruction);
            $this->drawCurrentPosition();
        } else {
            throw new \InvalidArgumentException('Unknown instruction: ' . print_r($instruction, true));
        }
    }

    private function walkForward(int $steps): void
    {
        while ($steps--) {
            $newX = $this->x + $this->currentDirection->toX();
            $newY = $this->y + $this->currentDirection->toY();

            if (! isset($this->map[$newY][$newX])) {
                if ($this->currentDirection->toX() > 0) {
                    // wrap right to left
                    $newX = min(array_keys($this->map[$newY]));
                } elseif ($this->currentDirection->toX() < 0) {
                    // wrap left to right
                    $newX = max(array_keys($this->map[$newY]));
                } elseif ($this->currentDirection->toY() > 0) {
                    // wrap up to bottom
                    $newY = min(array_keys($this->map));

                    while (! isset($this->map[$newY][$newX])) {
                        ++$newY;
                    }
                } elseif ($this->currentDirection->toY() < 0) {
                    // wrap bottom to up
                    $newY = max(array_keys($this->map));

                    while (! isset($this->map[$newY][$newX])) {
                        --$newY;
                    }
                } else {
                    throw new \InvalidArgumentException('Unknown wrapping around');
                }
            }

            $newTile = $this->map[$newY][$newX];
            switch ($newTile) {
                case '#':
                    $steps = 0;
                    break;
                case '>':
                case '<':
                case 'v':
                case 'A':
                case '.':
                    $this->x = $newX;
                    $this->y = $newY;
                    break;
                default:
                    throw new \InvalidArgumentException('Unknown new tile: ' . $newTile);
            }

            $this->drawCurrentPosition();
        }
    }

    public function printMap(): string
    {
        $map = '';

        foreach ($this->map as $row) {
            foreach (range(1, max(array_keys($row))) as $x) {
                $map .= $row[$x] ?? ' ';
            }

            $map .= PHP_EOL;
        }

        return $map;
    }

    protected function drawCurrentPosition(): void
    {
        $this->map[$this->y][$this->x] = $this->currentDirection->toMap();
    }
}
