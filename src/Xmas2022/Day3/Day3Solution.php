<?php

namespace Jean85\AdventOfCode\Xmas2022\Day3;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2022\Input;

class Day3Solution implements SolutionInterface, SecondPartSolutionInterface
{


    public function solve(): string
    {

        $input = Input::read(__DIR__);

        $rows = explode("\n", $input);

        $punteggio = 0;

        foreach ($rows as $row) {
            $data = str_split($row, strlen($row) / 2);

            $letter = array_intersect(str_split($data[0]), str_split($data[1]));


            $asciCode = ord(array_pop($letter));

            $punteggioParziale = ($asciCode >= 97) ? $asciCode - 96 : $asciCode - 64 + 26;

            $punteggio += $punteggioParziale;
        }

        return $punteggio;
    }


    public function solveSecondPart(): string
    {

        $input = Input::read(__DIR__);

        $rows = explode("\n", $input);

        $punteggio = 0;

        $riga = 1;

        foreach ($rows as $k => $row) {


            if (!(($k + 1) % 3)) {
                $letter = array_intersect(str_split($rows[$k]), str_split($rows[$k - 1]), str_split($rows[$k - 2]));
                $asciCode = ord(array_pop($letter));

                $punteggioParziale = ($asciCode >= 97) ? $asciCode - 96 : $asciCode - 64 + 26;
                $punteggio += $punteggioParziale;
            }


        }

        return $punteggio;
    }
}
