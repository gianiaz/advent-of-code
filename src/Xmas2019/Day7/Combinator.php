<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day7;

class Combinator
{
    public static function generateCombinations(array $values)
    {
        if (count($values) === 1) {
            yield $values;
        }

        foreach ($values as $item) {
            $copy = array_filter($values, static function (int $a) use ($item) {
                return $a !== $item;
            });

            foreach (self::generateCombinations($copy) as $remainders) {
                array_unshift($remainders, $item);

                yield $remainders;
            }
        }
    }
}
