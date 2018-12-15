<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day12;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day12Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve()
    {
        return '';
        $tunnel = new Tunnel($this->getInitialState(), $this->getRules());

        foreach (range(1, 20) as $generation) {
            $tunnel->evolve();
        }

        return $tunnel->getSum();
    }

    public function solveSecondPart()
    {
        $tunnel = new Tunnel($this->getInitialState(), $this->getRules());

        for ($generation = 0; $generation < 50000000000; ++$generation) {
            if ($generation % 100000 === 0) {
                echo date('h:i:s ') . $generation . PHP_EOL;
            }
            $tunnel->evolve();
        }

        return $tunnel->getSum();
    }

    private function getInitialState(): string
    {
        return '#.#.#..##.#....#.#.##..##.##..#..#...##....###..#......###.#..#.....#.###.#...#####.####...#####.#.#';
    }

    private function getRules(): array
    {
        return [
            '..#..' => '.',
            '#...#' => '.',
            '.#...' => '#',
            '#.##.' => '.',
            '..#.#' => '#',
            '#.#.#' => '.',
            '###..' => '#',
            '###.#' => '#',
            '.....' => '.',
            '....#' => '.',
            '.##..' => '#',
            '#####' => '.',
            '####.' => '.',
            '..##.' => '.',
            '##.#.' => '#',
            '.#..#' => '#',
            '##..#' => '.',
            '.##.#' => '.',
            '.####' => '#',
            '..###' => '.',
            '...##' => '#',
            '#..##' => '#',
            '#....' => '.',
            '##.##' => '.',
            '#.#..' => '.',
            '##...' => '.',
            '.#.##' => '#',
            '.###.' => '#',
            '...#.' => '.',
            '#.###' => '.',
            '#..#.' => '#',
            '.#.#.' => '.',
        ];
    }
}
