<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day13;

class Cart
{
    public const DIRECTION_UP = '^';
    public const DIRECTION_DOWN = 'v';
    public const DIRECTION_LEFT = '<';
    public const DIRECTION_RIGHT = '>';
    public const DIRECTION_CRASHED = 'X';

    /** @var string */
    private $currentDirection;

    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var int */
    private $crossingCount = 0;

    public function __construct(string $currentDirection, int $x, int $y)
    {
        $this->currentDirection = $currentDirection;
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function __toString(): string
    {
        return $this->currentDirection;
    }

    public function setCrashed(): void
    {
        $this->currentDirection = self::DIRECTION_CRASHED;
    }

    public function isCrashed(): bool
    {
        return $this->currentDirection === self::DIRECTION_CRASHED;
    }

    public function getCoordHash(): string
    {
        return $this->x . '-' . $this->y;
    }

    public function tick(string $nextPieceOfTrack): void
    {
        $this->x = $this->getNextX();
        $this->y = $this->getNextY();

        $this->currentDirection = $this->handleTurns($nextPieceOfTrack);
    }

    public function getNextX(): int
    {
        switch ($this->currentDirection) {
            case self::DIRECTION_LEFT:
                return $this->x - 1;
            case self::DIRECTION_RIGHT:
                return $this->x + 1;
            case self::DIRECTION_UP:
            case self::DIRECTION_DOWN:
                return $this->x;
            default:
                throw new \InvalidArgumentException('Unrecognized direction: ' . $this->currentDirection);
        }
    }

    public function getNextY(): int
    {
        switch ($this->currentDirection) {
            case self::DIRECTION_LEFT:
            case self::DIRECTION_RIGHT:
                return $this->y;
            case self::DIRECTION_UP:
                return $this->y - 1;
            case self::DIRECTION_DOWN:
                return $this->y + 1;
            default:
                throw new \InvalidArgumentException('Unrecognized direction: ' . $this->currentDirection);
        }
    }

    private function handleTurns(string $nextPieceOfTrack): string
    {
        switch ($nextPieceOfTrack) {
            case '+':
                return $this->handleCrossing();
            case '/':
                if ($this->currentDirection === self::DIRECTION_RIGHT || $this->currentDirection === self::DIRECTION_LEFT) {
                    return $this->turnLeft();
                }

                return $this->turnRight();
            case '\\':
                if ($this->currentDirection === self::DIRECTION_RIGHT || $this->currentDirection === self::DIRECTION_LEFT) {
                    return $this->turnRight();
                }

                return $this->turnLeft();
            default:
                return $this->currentDirection;
        }
    }

    private function handleCrossing(): string
    {
        switch ($this->crossingCount++ % 3) {
            case 0: // left
                return $this->turnLeft();
            case 1: // straight
                return $this->currentDirection;
            case 2: // right
                return $this->turnRight();
        }
    }

    private function turnLeft(): string
    {
        switch ($this->currentDirection) {
            case self::DIRECTION_UP:
                return self::DIRECTION_LEFT;
            case self::DIRECTION_DOWN:
                return self::DIRECTION_RIGHT;
            case self::DIRECTION_RIGHT:
                return self::DIRECTION_UP;
            case self::DIRECTION_LEFT:
                return self::DIRECTION_DOWN;
        }
    }

    private function turnRight(): string
    {
        switch ($this->currentDirection) {
            case self::DIRECTION_UP:
                return self::DIRECTION_RIGHT;
            case self::DIRECTION_DOWN:
                return self::DIRECTION_LEFT;
            case self::DIRECTION_RIGHT:
                return self::DIRECTION_DOWN;
            case self::DIRECTION_LEFT:
                return self::DIRECTION_UP;
        }
    }
}
