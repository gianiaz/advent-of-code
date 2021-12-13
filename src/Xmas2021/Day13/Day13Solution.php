<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day13;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day13Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        [$coordinates, $instructions] = explode(PHP_EOL . PHP_EOL, $input);

        $paper = new FoldablePaper($coordinates);

        foreach (explode(PHP_EOL, $instructions) as $instructions) {
            if (1 !== preg_match('/^fold along (x|y)=(\d+)$/', $instructions, $matches)) {
                throw new \RuntimeException('preg_match failed: ' . preg_last_error_msg());
            }

            $coordinate = (int) $matches[2];

            switch ($matches[1]) {
                case 'x':
                    $paper->foldX($coordinate);

                    return $paper->countDots();
                case 'y':
                    $paper->foldY($coordinate);

                    return $paper->countDots();
                default:
                    throw new \InvalidArgumentException($matches[1]);
            }
        }
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }
}
