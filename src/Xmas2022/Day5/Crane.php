<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day5;

class Crane
{
    /**
     * @var array<int, list<int>>
     */
    private array $stacks = [];

    public function __construct(string $input)
    {
        [$cratesInput, $instructionsInput] = explode(PHP_EOL . PHP_EOL, $input);
        $this->parseCratesInput($cratesInput);
    }

    private function parseCratesInput(string $cratesInput): void
    {
        $rows = explode(PHP_EOL, $cratesInput);
        $counterRow = array_pop($rows);
        $crateCount = 1 + floor(strlen($counterRow) / 4);

        foreach (array_reverse($rows) as $row) {
            for ($i = 0; $i < $crateCount; ++$i) {
                $position = 1 + ($i * 4);
                if ((1 + strlen($row)) < $position) {
                    continue;
                }

                $possibleCrate = $row[$position] ?? ' ';

                if ($possibleCrate !== ' ') {
                    $this->stacks[$i + 1][] = $possibleCrate;
                }
            }
        }
    }

    /**
     * @return array<int, list<int>>
     */
    public function getStacks(): array
    {
        return $this->stacks;
    }
}
