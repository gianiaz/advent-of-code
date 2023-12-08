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

    public function countSteps(): int
    {
        $current = 'AAA';
        $steps = 0;
        foreach ($this->getInstructionsLoop() as $instruction) {
            if ($current === 'ZZZ') {
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

    public function countStepsAsGhost(): int
    {
        $currents = array_filter($this->nodes, fn(Node $node): bool => str_ends_with($node->name, 'A'));
        $steps = 0;

        foreach ($this->getInstructionsLoop() as $instruction) {
            $newCurrents = [];
            foreach ($currents as $node) {
                $newCurrents[] = $this->nodes[$node->getNext($instruction)];
            }

            ++$steps;
            $currents = $newCurrents;
            $currentsNotInFinalState = array_filter($currents, fn(Node $node): bool => ! str_ends_with($node->name, 'Z'));

            if (count($currentsNotInFinalState) === 0) {
                return $steps;
            }
        }
    }
}
