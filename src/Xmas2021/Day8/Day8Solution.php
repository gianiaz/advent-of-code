<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day8;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day8Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const LENGTH_1 = 2;
    private const LENGTH_4 = 4;
    private const LENGTH_7 = 3;
    private const LENGTH_8 = 7;
    private const LENGTH_2_3_OR_5 = 5;
    private const LENGTH_0_6_OR_9 = 6;

    /** @var array<string, int> */
    private array $mapping = [];
    /** @var array<int, string> */
    private array $reverseMapping = [];

    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $countByLength = [];
        foreach (range(1, 7) as $lenght) {
            $countByLength[$lenght] = 0;
        }

        foreach (explode(PHP_EOL, $input) as $row) {
            [$first, $second] = explode(' | ', $row);
            foreach (explode(' ', $second) as $value) {
                $countByLength[strlen($value)] += 1;
            }
        }

        return $countByLength[self::LENGTH_1] // 1
            + $countByLength[self::LENGTH_4] // 4
            + $countByLength[self::LENGTH_7] // 7
            + $countByLength[self::LENGTH_8] // 8
        ;
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        $total = 0;

        foreach (explode(PHP_EOL, $input) as $i => $row) {
            [$first, $second] = explode(' | ', $row);
            $this->prepopulateMappings(explode(' ', $first));

            $rowValue = '';
            foreach (explode(' ', $second) as $value) {
                $rowValue .= $this->getValue($this->sortString($value));
            }
            $total += (int) $rowValue;
        }

        return $total;
    }

    private function prepopulateMappings(array $mappings): void
    {
        $this->mapping = [];
        $this->reverseMapping = [];

        foreach ($mappings as $value) {
            if (in_array(strlen($value), [
                self::LENGTH_1,
                self::LENGTH_4,
                self::LENGTH_7,
                self::LENGTH_8,
            ])) {
                $this->getValue($this->sortString($value));
            }
        }

        if (isset($this->reverseMapping[4]) && (isset($this->reverseMapping[1]) || isset($this->reverseMapping[7]))) {
            return;
        }

        throw new \RuntimeException('Unable to init mappings');
    }

    private function getValue(string $value): int
    {
        if (isset($this->mapping[$value])) {
            return $this->mapping[$value];
        }

        $int = $this->decodeString($value);

        $this->reverseMapping[$int] = $value;

        return $this->mapping[$value] = $int;
    }

    private function decodeString(string $value): int
    {
        switch (strlen($value)) {
            case self::LENGTH_1:
                return 1;
            case self::LENGTH_4:
                return 4;
            case self::LENGTH_7:
                return 7;
            case self::LENGTH_8:
                return 8;
            case self::LENGTH_0_6_OR_9:
                if (isset($this->reverseMapping[1])) {
                    switch ($this->countIntersection($value, $this->reverseMapping[1])) {
                        case 1:
                            return 6;
                        case 2:
                            return 9;
                        default:
                            throw new \InvalidArgumentException('Cannot map value between 6 and 9: ' . $value);
                    }
                } elseif (isset($this->reverseMapping[7])) {
                    switch ($this->countIntersection($value, $this->reverseMapping[7])) {
                        case 2:
                            return 6;
                        case 3:
                            return 9;
                        default:
                            throw new \InvalidArgumentException('Cannot map value between 6 and 9: ' . $value);
                    }
                }
                // no break
            case self::LENGTH_2_3_OR_5:
                if (! isset($this->reverseMapping[1]) && ! isset($this->reverseMapping[7])) {
                    throw new \RuntimeException('Cannot proceed, mapping missing for both 1 & 7');
                }
                if (isset($this->reverseMapping[7]) && 3 === $this->countIntersection($value, $this->reverseMapping[7])) {
                    return 3;
                }
                if (isset($this->reverseMapping[1]) && 2 === $this->countIntersection($value, $this->reverseMapping[1])) {
                    return 3;
                }
                if (2 === $this->countIntersection($value, $this->reverseMapping[4])) {
                    return 2;
                }
                if (3 === $this->countIntersection($value, $this->reverseMapping[4])) {
                    return 5;
                }
                // no break
            default:
                throw new \InvalidArgumentException('Cannot map value: ' . $value);
        }
    }

    private function countIntersection(string $value, string $comparison): int
    {
        return count(array_intersect(str_split($value), str_split($comparison)));
    }

    private function sortString(string $value): string
    {
        $exploded = str_split($value);
        sort($exploded);

        return implode($exploded);
    }
}
