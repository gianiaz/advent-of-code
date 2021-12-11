<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day11;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day11Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $errorPoints = 0;
        foreach ($this->getLines($input) as $line) {
            $invalidChar = $this->getFirstIllegalCharacter($line);
            if (null !== $invalidChar['char']) {
                $errorPoints += $this->getIllegalCharacterPoints($invalidChar['char']);
            }
        }

        return $errorPoints;
    }

    public function solveSecondPart(string $input = null)
    {
        $autocompletePoints = [];
        foreach ($this->getLines($input) as $line) {
            $invalidChar = $this->getFirstIllegalCharacter($line);
            if (null !== $invalidChar['expected']) {
                $autocompletePoints[] = $this->getAutocompletePoints($invalidChar['expected']);
            }
        }

        sort($autocompletePoints);

        return $autocompletePoints[count($autocompletePoints) / 2];
    }

    /**
     * @return \Generator<string>
     */
    private function getLines(string $input = null): \Generator
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        yield from explode(PHP_EOL, $input);
    }

    /**
     * @return array{char: string|null, position: positive-int, expected: string|null}
     */
    public function getFirstIllegalCharacter(string $line): array
    {
        $expectedClosingStack = [];

        foreach (str_split($line) as $i => $char) {
            switch ($char) {
                case '(':
                    $expectedClosingStack[] = ')';
                    break;
                case '[':
                    $expectedClosingStack[] = ']';
                    break;
                case '{':
                    $expectedClosingStack[] = '}';
                    break;
                case '<':
                    $expectedClosingStack[] = '>';
                    break;
                case ')':
                case ']':
                case '}':
                case '>':
                    $prevFromStack = array_pop($expectedClosingStack);
                    if ($prevFromStack !== $char) {
                        return ['char' => $char, 'position' => $i, 'expected' => null];
                    }
                    break;
                default:
                    throw new \InvalidArgumentException($char);
            }
        }

        if (! empty($expectedClosingStack)) {
            return ['char' => null, 'position' => null, 'expected' => implode(array_reverse($expectedClosingStack))];
        }

        return ['char' => null, 'position' => null, 'expected' => null];
    }

    private function getIllegalCharacterPoints(string $invalidChar): int
    {
        switch ($invalidChar) {
            case ')':
                return 3;
            case ']':
                return 57;
            case '}':
                return 1197;
            case '>':
                return 25137;
            default:
                throw new \InvalidArgumentException($invalidChar);
        }
    }

    private function getAutocompletePoints(string $expected): int
    {
        $total = 0;
        $points = [
            ')' => 1,
            ']' => 2,
            '}' => 3,
            '>' => 4,
        ];

        foreach (str_split($expected) as $char) {
            $total *= 5;
            $total += $points[$char];
        }

        return $total;
    }
}
