<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day8;

class Map
{
    private function __construct(
        /** @var list<Direction> */
        private readonly array $instructions,
        /** @var array<string, Node> */
        private readonly array $nodes,
    ) {}

    public static function parse(string $input): self
    {
        [$firstLine, $rest] = explode(PHP_EOL . PHP_EOL, trim($input));

        $instructions = [];
        foreach (str_split(trim($firstLine)) as $direction) {
            $instructions[] = Direction::from($direction);
        }

        $nodes = [];
        foreach (explode(PHP_EOL, trim($rest)) as $row) {
            $newNode = Node::parse($row);
            $nodes[$newNode->name] = $newNode;
        }

        return new self($instructions, $nodes);
    }

    public function countSteps(string $from, string $to): int
    {
        $current = $from;
        $steps = 0;
        foreach ($this->getInstructionsLoop() as $instruction) {
            if ($current === $to) {
                return $steps;
            }

            $current = $this->nodes[$current]->getNext($instruction);
            ++$steps;
        }
    }

    private function getInstructionsLoop(): \Generator
    {
        do {
            yield from $this->instructions;
        } while (true);
    }
}
