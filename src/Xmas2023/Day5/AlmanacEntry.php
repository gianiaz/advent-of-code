<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day5;

use Webmozart\Assert\Assert;

class AlmanacEntry
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        /** @var array<int, int> */
        private readonly array $map,
    ) {}

    public static function parse(string $input): self
    {
        $rows = explode(PHP_EOL, trim($input));

        $entryDescription = array_shift($rows);

        \Safe\preg_match('/^(\w+)-to-(\w+) map:/', $entryDescription, $matches);

        $map = [];
        foreach ($rows as $row) {
            $numbers = explode(' ', $row);
            Assert::count($numbers, 3);
            $length = (int) $numbers[2];
            $destination = (int) $numbers[0];
            $source = (int) $numbers[1];

            do {
                $map[$source++] = $destination++;
            } while (--$length);
        }

        return new self($matches[1], $matches[2], $map);
    }

    public function convert(int $number): int
    {
        return $this->map[$number] ?? $number;
    }
}
