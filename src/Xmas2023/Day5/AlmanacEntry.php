<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day5;

use Webmozart\Assert\Assert;

class AlmanacEntry
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        /** @var Map[] */
        private readonly array $maps,
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
            $range = (int) $numbers[2];
            $destination = (int) $numbers[0];
            $source = (int) $numbers[1];

            $map[] = new Map($source, $destination, $range);
        }

        return new self($matches[1], $matches[2], $map);
    }

    public function convert(int $number): int
    {
        foreach ($this->maps as $map) {
            if (! $map->isInRange($number)) {
                continue;
            }

            return $map->mapValue($number);
        }

        return $number;
    }
}
