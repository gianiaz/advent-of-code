<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day10;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day10Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $errorPoints = 0;
        foreach ($this->getLines($input) as $line) {
            if (null !== $invalidChar = $this->getFirstIllegalCharacter($line)) {
                $errorPoints += $this->getIllegalCharacterPoints($invalidChar);
            }
        }

        return $errorPoints;
    }

    public function solveSecondPart(string $input = null)
    {
        $this->getLines($input);
    }

    /**
     * @return \Generator<string>
     */
    private function getLines(string $input = null): \Generator
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        yield from explode(PHP_EOL, $input);
    }

    public function getFirstIllegalCharacter(string $line): ?string
    {
        $expectedClosingStack = [];

        foreach (str_split($line) as $char) {
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
                        return $char;
                    }
                    break;
                default:
                    throw new \InvalidArgumentException($char);
            }
        }

        return null;
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
}
