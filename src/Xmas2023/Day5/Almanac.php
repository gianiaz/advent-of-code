<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day5;

class Almanac
{
    public function __construct(
        /** @var string[] */
        private readonly array $seeds,
        /** @var array<string,AlmanacEntry> */
        private array $entries,
    ) {}

    public static function parse(string $input): self
    {
        $entries = [];

        $explodedInput = explode(PHP_EOL . PHP_EOL, trim($input));
        $seeds = explode(' ', substr(array_shift($explodedInput), 7));

        foreach ($explodedInput as $entry) {
            $almanacEntry = AlmanacEntry::parse($entry);
            $entries[$almanacEntry->from] = $almanacEntry;
        }

        return new self($seeds, $entries);
    }

    /**
     * @return \Generator<int>
     */
    public function getSeeds(): \Generator
    {
        foreach ($this->seeds as $seed) {
            yield (int) $seed;
        }
    }

    public function getLocation(int $number, string $type = 'seed'): int
    {
        $almanacEntry = $this->entries[$type]
            ?? throw new \LogicException('Unable to find almanac entry for ' . $type);

        $newNumber = $almanacEntry->convert($number);

        if ($almanacEntry->to === 'location') {
            return $newNumber;
        }

        return $this->getLocation($newNumber, $almanacEntry->to);
    }

    public function getLowestLocationFor(Interval $interval): int
    {
        if ($interval->type === 'location') {
            return $interval->start;
        }

        $almanacEntry = $this->entries[$interval->type]
            ?? throw new \LogicException('Unable to find almanac entry for ' . $interval->type);

        return min(
            array_map(
                $this->getLowestLocationFor(...),
                $almanacEntry->convertInterval($interval)
            )
        );
    }
}
