<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day14;

class Scan
{
    /** @var string[][] */
    private array $map;
    private int $minX;
    private int $minY;
    private int $maxX;
    private int $maxY;

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, $input) as $lineInstructions) {
            foreach ($this->parseInstructions($lineInstructions) as $b) {
                if (isset($a)) {
                    foreach (range($a[0], $b[0]) as $x) {
                        foreach (range($a[1], $b[1]) as $y) {
                            $this->map[$y][$x] = '#';
                            $this->maxX = max($this->maxX ?? 0, $x);
                            $this->maxY = max($this->maxY ?? 0, $y);
                            $this->minX = min($this->minX ?? PHP_INT_MAX, $x);
                            $this->minY = min($this->minY ?? PHP_INT_MAX, $y);
                        }
                    }
                }

                $a = $b;
            }

            unset($a);
        }
    }

    /**
     * @return \Generator<array{int, int}>
     */
    private function parseInstructions(string $lineInstructions): \Generator
    {
        $vertexes = explode(' -> ', $lineInstructions);

        foreach ($vertexes as $vertex) {
            if (1 !== \Safe\preg_match('/(\d+),(\d+)/', trim($vertex), $matches)) {
                throw new \InvalidArgumentException('Unable to parse vertex: ' . $vertex);
            }

            yield [
                (int) $matches[1],
                (int) $matches[2],
            ];
        }
    }

    public function dropSand(): int
    {
        $sandCount = 0;

        do {
            $sandX = 500;
            $sandY = 0;

            do {
                if ($sandY > $this->maxY) {
                    return $sandCount;
                }

                if ($this->isFree($sandX, $sandY + 1)) {
                    ++$sandY;
                    continue;
                }

                if ($this->isFree($sandX - 1, $sandY + 1)) {
                    --$sandX;
                    ++$sandY;
                    continue;
                }

                if ($this->isFree($sandX + 1, $sandY + 1)) {
                    ++$sandX;
                    ++$sandY;
                    continue;
                }

                $this->map[$sandY][$sandX] = 'o';
                ++$sandCount;

                break;
            } while (true);
        } while (true);
    }

    private function isFree(int $x, int $y): bool
    {
        return ! isset($this->map[$y][$x]);
    }

    public function printMap(): string
    {
        $result = '';

        foreach (range($this->minY, $this->maxY) as $y) {
            foreach (range($this->minX, $this->maxX) as $x) {
                $result .= $this->map[$y][$x] ?? ' ';
            }
            $result .= PHP_EOL;
        }

        return $result;
    }
}
