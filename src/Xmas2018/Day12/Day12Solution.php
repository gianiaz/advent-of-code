<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day12;

use Jean85\AdventOfCode\SolutionInterface;

class Day12Solution implements SolutionInterface
{
    public function solve()
    {
        $tunnel = new Tunnel($this->getInitialState(), $this->getRules());

        foreach (range(1, 20) as $generation) {
            $tunnel = $tunnel->getNextGeneration();
        }

        return $tunnel->getSum();
    }

    private function getInitialState(): array
    {
        return str_split('#.#.#..##.#....#.#.##..##.##..#..#...##....###..#......###.#..#.....#.###.#...#####.####...#####.#.#');
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
