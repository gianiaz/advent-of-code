<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day21;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day21Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var array<string, int|UnresolvedMonkey> */
    private array $monkeys;

    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        foreach (explode(PHP_EOL, $input) as $instruction) {
            $name = substr($instruction, 0, 4);
            $this->monkeys[$name] = $this->parseMonkeyDescription(substr($instruction, 6));
        }

        return (string) $this->resolveMonkey('root');
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return (string) ($result * $decryptionKey);
    }

    private function parseMonkeyDescription(string $description): int|UnresolvedMonkey
    {
        if (is_numeric($description)) {
            return (int) $description;
        }

        if (1 !== \Safe\preg_match("/(?'a'\w{4}) (?'op'[+-\/\*]) (?'b'\w{4})/", $description, $matches)) {
            throw new \InvalidArgumentException('Unable to parse description: ' . $description);
        }

        return new UnresolvedMonkey(
            $matches['a'],
            Operation::from($matches['op']),
            $matches['b'],
        );
    }

    private function resolveMonkey(string $name): int
    {
        $monkey = $this->monkeys[$name] ?? throw new \InvalidArgumentException('Unable to find monkey ' . $name);

        if (is_int($monkey)) {
            return $monkey;
        }

        if ($monkey instanceof UnresolvedMonkey) {
            return $monkey->operation->apply(
                $this->resolveMonkey($monkey->a),
                $this->resolveMonkey($monkey->b),
            );
        }

        throw new \InvalidArgumentException('Malformed monkey: ' . print_r($monkey, true));
    }
}
