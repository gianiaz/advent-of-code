<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day21;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day21Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public const HUMAN = 'humn';
    /** @var array<string, int|UnresolvedMonkey> */
    private array $monkeys;

    public function solve(string $input = null): string
    {
        $this->parseInput($input);

        return (string) $this->resolveMonkey('root');
    }

    public function solveSecondPart(string $input = null): string
    {
        $this->parseInput($input);
        $this->monkeys[self::HUMAN] = new UnresolvedMonkey('unknown', Operation::Divide, 'unknown');

        $this->resolveAsManyMonkeysAsPossible();

        $root = $this->monkeys['root'];
        [$solvedBranch, $unresolvedBranch] = $this->getBranches($root);

        return (string) $this->reverse($unresolvedBranch, $solvedBranch);
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

    private function resolveMonkey(string $name, bool $ignoreHuman = false): int|float
    {
        if ($ignoreHuman && $name === self::HUMAN) {
            throw new \RuntimeException('Human encountered');
        }

        $monkey = $this->monkeys[$name] ?? throw new \InvalidArgumentException('Unable to find monkey ' . $name);

        if (is_numeric($monkey)) {
            return $monkey;
        }

        if ($monkey instanceof UnresolvedMonkey) {
            $result = $monkey->operation->apply(
                $this->resolveMonkey($monkey->a, $ignoreHuman),
                $this->resolveMonkey($monkey->b, $ignoreHuman),
            );

            return $this->monkeys[$name] = $result;
        }

        throw new \InvalidArgumentException('Malformed monkey: ' . print_r($monkey, true));
    }

    private function parseInput(?string $input): void
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        foreach (explode(PHP_EOL, $input) as $instruction) {
            $name = substr($instruction, 0, 4);
            $this->monkeys[$name] = $this->parseMonkeyDescription(substr($instruction, 6));
        }
    }

    private function resolveAsManyMonkeysAsPossible(): void
    {
        $unresolvedMonkeys = $this->monkeys;

        do {
            $resolved = false;

            foreach ($unresolvedMonkeys as $name => $monkey) {
                try {
                    $this->resolveMonkey($name, true);
                    unset($unresolvedMonkeys[$name]);
                    $resolved = true;
                } catch (\RuntimeException) {
                }
            }
        } while ($resolved);
    }

    private function reverse(UnresolvedMonkey $unresolvedMonkey, int|float $target): int|float
    {
        $unresolvedBranch = $this->monkeys[$unresolvedMonkey->a] instanceof UnresolvedMonkey
            ? $this->monkeys[$unresolvedMonkey->a]
            : $this->monkeys[$unresolvedMonkey->b];

        $newTarget = $unresolvedMonkey->operation->reverse(
            $target,
            $this->monkeys[$unresolvedMonkey->a],
            $this->monkeys[$unresolvedMonkey->b],
        );

        if (in_array(self::HUMAN, [$unresolvedMonkey->a, $unresolvedMonkey->b], true)) {
            return $newTarget;
        }

        return $this->reverse($unresolvedBranch, $newTarget);
    }

    /**
     * @return array{int, UnresolvedMonkey}
     */
    private function getBranches(int|string|UnresolvedMonkey $root): array
    {
        $solvedBranch = is_int($this->monkeys[$root->a])
            ? $this->monkeys[$root->a]
            : $this->monkeys[$root->b];

        $unresolvedMonkey = $this->monkeys[$root->a] instanceof UnresolvedMonkey
            ? $this->monkeys[$root->a]
            : $this->monkeys[$root->b];

        return [$solvedBranch, $unresolvedMonkey];
    }
}
