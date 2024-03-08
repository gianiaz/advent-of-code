<?php

namespace Jean85\AdventOfCode\Xmas2022\Day1;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2022\Input;

class Day1Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(): string
    {

        $input = Input::read(__DIR__);

        $elfMap = explode("\n\n", $input);

        $winner = 0;

        foreach($elfMap as $elf) {
            $calories = explode("\n", $elf);

            $weight = array_sum($calories);

            $winner = max($winner, $weight);
        }

        return $winner;

    }


    public function solveSecondPart(): string
    {
        $input = Input::read(__DIR__);

        $elfMap = explode("\n\n", $input);

        $classifica = [];

        foreach($elfMap as  $elf) {
            $calories = explode("\n", $elf);

            $classifica[] = array_sum($calories);


        }

        sort($classifica);

        return array_sum(array_slice($classifica, -3));
    }
}
