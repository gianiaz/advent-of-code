<?php

namespace Jean85\AdventOfCode\Xmas2022\Day4;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2022\Input;

class Day4Solution implements SolutionInterface, SecondPartSolutionInterface
{


    public function solve(): string
    {
        $input = Input::read(__DIR__);

        $rows = explode("\n", $input);

        $result = 0;

        foreach ($rows as $row) {
            $pair = explode(',', $row);

            $first = explode('-', $pair[0]);
            $second = explode('-', $pair[1]);

            if ($first[0] <= $second[0] && $first[1] >= $second[1]) {
                $result++;
            } elseif ($first[0] >= $second[0] && $first[1] <= $second[1]) {
                $result++;
            }
        }

        return $result;
    }

    public function solveSecondPart(): string
    {
        $input = Input::read(__DIR__);

        $rows = explode("\n", $input);

        $result = 0;

        foreach ($rows as $row) {
            $pair = explode(',', $row);

            $first = explode('-', $pair[0]);
            $second = explode('-', $pair[1]);

            if (
                ($first[0] >= $second[0] && $first[0] <= $second[1]) ||
                ($first[1] >= $second[0] && $first[1] <= $second[1]) ||
                ($second[0] >= $first[0] && $second[0] <= $first[1]) ||
                ($second[1] >= $first[0] && $second[1] <= $first[1])) {
                $result++;
            }
        }

        return $result;
    }
}
