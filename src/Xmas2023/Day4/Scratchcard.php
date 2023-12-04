<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day4;

class Scratchcard
{
    private function __construct(
        /** @var list<string> */
        public readonly array $winningNumbers,
        /** @var list<string> */
        public readonly array $numbers,
    ) {}

    public static function parse(string $input): self
    {
        [$winningNumbers, $numbers] = explode('|', $input);
        $numbers = preg_replace('/\s+/', ' ', $numbers);

        return new self(
            explode(' ', trim($winningNumbers)),
            explode(' ', trim($numbers)),
        );
    }

    public function getPoints(): int
    {
        $overlappingNumbers = count(array_intersect($this->winningNumbers, $this->numbers));

        if ($overlappingNumbers === 0) {
            return 0;
        }

        $points = 1;

        while (--$overlappingNumbers) {
            $points *= 2;
        }

        return $points;
    }
}
