<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day3;

use Webmozart\Assert\Assert;

class Map
{
    public function __construct(
        /** @var list<list<non-empty-string>> */
        private array $map
    ) {}

    public static function parse(string $input): self
    {
        $map = [];

        $rows = explode(PHP_EOL, $input);
        foreach ($rows as $row) {
            $map[] = str_split($row);
        }

        return new self($map);
    }

    /**
     * @return int[]
     */
    public function getNumbers(): array
    {
        $numbers = [];

        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $symbol) {
                if ($symbol === '.' || is_numeric($symbol)) {
                    continue;
                }

                foreach ($this->extractNumbersAround($x, $y) as $newNumber) {
                    $numbers[] = $newNumber;
                }
            }
        }

        return $numbers;
    }

    /**
     * @return int[]
     */
    public function getGearRatios(): array
    {
        $numbers = [];

        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $symbol) {
                if ($symbol !== '*') {
                    continue;
                }

                $ratios = iterator_to_array($this->extractNumbersAround($x, $y));

                if (count($ratios) !== 2) {
                    continue;
                }

                $numbers[] = $ratios[0] * $ratios[1];
            }
        }

        return $numbers;
    }

    /**
     * @return \Generator<int>
     */
    private function extractNumbersAround(int $startX, int $startY): \Generator
    {
        foreach (range($startX - 1, $startX + 1) as $x) {
            foreach (range($startY - 1, $startY + 1) as $y) {
                if (! is_numeric($this->map[$y][$x])) {
                    continue;
                }

                yield $this->extractNumberAt($x, $y);
            }
        }
    }

    private function extractNumberAt(int $x, int $y): int
    {
        while (is_numeric($this->map[$y][$x] ?? '')) {
            --$x;
        }

        $number = '';
        while (is_numeric($this->map[$y][++$x] ?? '')) {
            $number .= $this->map[$y][$x];
            $this->map[$y][$x] = '.';
        }

        Assert::numeric($number);

        return (int) $number;
    }
}
