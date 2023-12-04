<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day4;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2023\Input;

class Day4Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $solution = 0;

        foreach (explode(PHP_EOL, $input) as $row) {
            [$cardNumber, $scratchcardInput] = explode(': ', $row);
            $solution += Scratchcard::parse(trim($scratchcardInput))->getPoints();
        }

        return (string) $solution;
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= Input::read(__DIR__);

        $scratchcards = [];

        foreach (explode(PHP_EOL, $input) as $row) {
            [$cardNumber, $scratchcardInput] = explode(': ', $row);
            $number = trim(substr($cardNumber, 4));
            $scratchcards[$number] = Scratchcard::parse(trim($scratchcardInput));
        }

        $total = 0;
        foreach ($scratchcards as $number => $scratchcard) {
            try {
                $total += $this->countScratchcardsRecursively($scratchcards, $number);
            } catch (\Throwable $e) {
                print_r($number);
                die();
            }
        }

        return (string) $total;
    }

    /**
     * @param list<Scratchcard> $scratchcards
     */
    private function countScratchcardsRecursively(array $scratchcards, int $number): int
    {
        /** @var array<int, int> $memoization */
        static $memoization;

        if (isset($memoization[$number])) {
            return $memoization[$number];
        }

        $startNumber = $number;

        $total = 1;

        $scratchcard = $scratchcards[$number];
        $winCount = $scratchcard->getOverlapCount();

        while ($winCount--) {
            $total += $this->countScratchcardsRecursively($scratchcards, ++$number);
        }

        $memoization[$startNumber] = $total;

        return $total;
    }
}
