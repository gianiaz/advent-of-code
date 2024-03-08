<?php

namespace Jean85\AdventOfCode\Xmas2022\Day2;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2022\Input;

class Day2Solution implements SolutionInterface, SecondPartSolutionInterface
{

    public function solve(): string
    {

        $input = Input::read(__DIR__);

        $rows = explode("\n", $input);


        $total = 0;

        foreach ($rows as $row) {

            $total += match ($row) {
                "A X" => 4,
                "A Y" => 8,
                "A Z" => 3,
                "B X" => 1,
                "B Y" => 5,
                "B Z" => 9,
                "C X" => 7,
                "C Y" => 2,
                "C Z" => 6,
            };

        }

        return $total;

    }

    public function solveSecondPart(): string
    {
        $input = Input::read(__DIR__);

        $rows = explode("\n", $input);

        $total = 0;

        foreach ($rows as $row) {

            $total += match ($row) {
                "A X" => 3,
                "A Y" => 4,
                "A Z" => 8,
                "B X" => 1,
                "B Y" => 5,
                "B Z" => 9,
                "C X" => 2,
                "C Y" => 6,
                "C Z" => 7
            };

        }
        return $total;
    }

}
