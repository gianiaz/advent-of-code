<?php

namespace Jean85\AdventOfCode\Xmas2022\Day5;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
use Jean85\AdventOfCode\Xmas2022\Input;

class Day5Solution implements SolutionInterface, SecondPartSolutionInterface
{

    public function solve(): string
    {
        $input = file_get_contents(__DIR__.'/input.txt');

        [$crates, $instructions] = explode("\n\n", $input);

        $cratesLines = explode(PHP_EOL, $crates);

        $cratesLines = array_reverse($cratesLines);

        $columns = array_shift($cratesLines);

        $map = [];

        foreach (str_split($columns) as $k => $char) {

            if (!is_numeric($char)) {
                continue;
            }

            foreach ($cratesLines as $crates) {
                $crate = $crates[$k] ?? '';
                if (ctype_alpha($crate)) {
                    $map[$char][] = $crate;
                }
            }
        }

        foreach (explode("\n", $instructions) as $instruction) {
            $positions = explode(' ', $instruction);

            $count = $positions[1];
            $from = $positions[3];
            $to = $positions[5];

            while ($count--){
                $map[$to][] = array_pop($map[$from]);
            }

        }

        $str = '';

        foreach ($map as $column) {
            $str .= array_pop($column);
        }


        return $str;
    }

    public function solveSecondPart(): string
    {
        $input = file_get_contents(__DIR__.'/input.txt');

        [$crates, $instructions] = explode("\n\n", $input);

        $cratesLines = explode(PHP_EOL, $crates);

        $cratesLines = array_reverse($cratesLines);

        $columns = array_shift($cratesLines);

        $map = [];

        foreach (str_split($columns) as $k => $char) {

            if (!is_numeric($char)) {
                continue;
            }

            foreach ($cratesLines as $crates) {
                $crate = $crates[$k] ?? '';
                if (ctype_alpha($crate)) {
                    $map[$char][] = $crate;
                }
            }
        }

        foreach (explode("\n", $instructions) as $instruction) {
            $positions = explode(' ', $instruction);

            $count = $positions[1];
            $from = $positions[3];
            $to = $positions[5];

            $data = [];

            while ($count--){

                $data[] = array_pop($map[$from]);

            }

            while ($data) {
                $map[$to][] = array_pop($data);
            }

        }

        $str = '';

        foreach ($map as $column) {
            $str .= array_pop($column);
        }


        return $str;
    }

}
