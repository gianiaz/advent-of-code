<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day15;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day15Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private $input;

    /**
     * Day15Solution constructor.
     *
     * @param $input
     */
    public function __construct(string $input = null)
    {
        $this->input = $input ?? $this->getDefaultInput();
    }

    public function solve()
    {
        $dungeon = new Dungeon($this->input);

        do {
        } while ($dungeon->tick());

        return $dungeon->getOutcome();
    }

    public function solveSecondPart()
    {
        $attack = 3;
        do {
            $noElvedDied = true;
            $dungeon = new AlteredDungeon($this->input, ++$attack);
            try {
                do {
                } while ($dungeon->tick());
            } catch (ElfDied $ops) {
                $noElvedDied = false;
            }
        } while (! $noElvedDied);

        return $dungeon->getOutcome();
    }

    private function getDefaultInput(): string
    {
        return '################################
##############..##.#############
###############.##.#############
#####..G#######....#########..##
###......########..########...##
####..#G.#######.G...######...##
####......######...G.#####..####
#####......#####.....#.....G####
###.G..#.#..G..#.G.G....#.######
###..#...#.....G.......#########
###......#....##..........######
###..#.G.#....G...........######
####.G.......G#####......G######
#####....#G..#######.....#######
####........#########...######.#
#######.....#########E..######.#
########....#########.#..#####.#
########....#########E#.E.###..#
########..E.#########......E...#
#######......#######.....E.....#
#######..G....#####.......##.###
#######........G........E.######
#######....................#####
########...............#....####
########.....E..G......##.######
##...#..#.#............##.######
#G.#.#..#.....E........#########
#.................E....#########
###...............#...##########
#####.....#.........#.##########
#####...####.#..#..##..#########
################################';
    }
}
