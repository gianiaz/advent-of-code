<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day5;

class Crane
{
    /**
     * @var array<int, list<int>>
     */
    private array $stacks = [];

    /**
     * @var Instruction[]
     */
    private array $instructions = [];

    public function __construct(string $input)
    {
        [$cratesInput, $instructionsInput] = explode(PHP_EOL . PHP_EOL, $input);
        $this->parseCratesInput($cratesInput);
        $this->parseInstructionsInput($instructionsInput);
    }

    public function run(): void
    {
        foreach ($this->instructions as $instruction) {
            $counter = $instruction->quantity;

            while ($counter--) {
                $crate = array_pop($this->stacks[$instruction->from]);
                $this->stacks[$instruction->to][] = $crate;
            }
        }
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

    private function parseInstructionsInput(string $instructionsInput): void
    {
        foreach (explode(PHP_EOL, trim($instructionsInput)) as $instruction) {
            $this->instructions[] = new Instruction($instruction);
        }
    }

    /**
     * @return array<int, list<int>>
     */
    public function getStacks(): array
    {
        return $this->stacks;
    }

    /**
     * @return Instruction[]
     */
    public function getInstructions(): array
    {
        return $this->instructions;
    }
}
