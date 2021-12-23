<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day20;

class Image
{
    /** @var array<int, array<int, bool>> */
    private array $image = [];
    private bool $default;
    private int $minX = 0;
    private int $maxX = 0;
    private int $minY = 0;
    private int $maxY = 0;

    public static function createFromString(string $input): self
    {
        $image = new self(false);

        foreach (explode(PHP_EOL, $input) as $y => $row) {
            foreach (str_split($row) as $x => $char) {
                if ($char === '#') {
                    $image->setPixel($x, $y, true);
                }
            }
        }

        return $image;
    }

    public function __construct(bool $default)
    {
        $this->default = $default;
    }

    public function setPixel(int $x, int $y, bool $on): void
    {
        $this->image[$y][$x] = $on;

        $this->minX = min($this->minX, $x);
        $this->maxX = max($this->minX, $x);
        $this->minY = min($this->minY, $y);
        $this->maxY = max($this->minY, $y);
    }

    public function getPixel(int $x, int $y): bool
    {
        return $this->image[$y][$x] ?? $this->default;
    }

    public function getBinaryPixelValue(int $x, int $y): string
    {
        return $this->getPixel($x, $y) ? '1' : '0';
    }

    public function getMinX(): int
    {
        return $this->minX;
    }

    public function getMaxX(): int
    {
        return $this->maxX;
    }

    public function getMinY(): int
    {
        return $this->minY;
    }

    public function getMaxY(): int
    {
        return $this->maxY;
    }

    public function getDefault(): bool
    {
        return $this->default;
    }

    public function extractValue(int $x, int $y): int
    {
        $binaryString = $this->getBinaryPixelValue($x - 1, $y - 1)
            . $this->getBinaryPixelValue($x, $y - 1)
            . $this->getBinaryPixelValue($x + 1, $y - 1)
            . $this->getBinaryPixelValue($x - 1, $y)
            . $this->getBinaryPixelValue($x, $y)
            . $this->getBinaryPixelValue($x + 1, $y)
            . $this->getBinaryPixelValue($x - 1, $y + 1)
            . $this->getBinaryPixelValue($x, $y + 1)
            . $this->getBinaryPixelValue($x + 1, $y + 1)
        ;

        return bindec(
            $binaryString
        );
    }

    public function countLights(): int
    {
        if ($this->default) {
            throw new \RuntimeException('Default is true, result is infinite');
        }

        $count = 0;
        foreach ($this->image as $row) {
            foreach ($row as $pixel) {
                if ($pixel) {
                    ++$count;
                }
            }
        }

        return $count;
    }

    public function __toString(): string
    {
        $string = '';

        foreach (range($this->getMinY(), $this->getMaxY()) as $y) {
            foreach (range($this->getMinX(), $this->getMaxX()) as $x) {
                $string .= $this->getPixel($x, $y) ? '#' : '.';
            }
            $string .= PHP_EOL;
        }

        return trim($string);
    }
}
