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

        // sort by source, so we can fill the gaps
        usort($map, fn(Map $a, Map $b) => $a->sourceStart <=> $b->sourceStart);

        return new self($matches[1], $matches[2], $map);
    }

    private function getMap(int $at): Map
    {
        $prev = null;

        foreach ($this->maps as $map) {
            if ($map->isInRange($at)) {
                return $map;
            }

            if ($map->sourceStart > $at) {
                return Map::identityBetween($prev, $map);
            }

            // we got it!
            if ($map->getSourceEnd() <= $at) {
                return $map;
            }

            $prev = $map;
        }

        return Map::identityBetween($map, null);
    }

    public function convert(int $number): int
    {
        $map = $this->getMap($number);

        return $map->mapValue($number);
    }

    /**
     * @return Interval[]
     */
    public function convertInterval(Interval $interval): array {}
}
