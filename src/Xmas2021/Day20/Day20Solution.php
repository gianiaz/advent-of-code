<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day20;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day20Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
        [$algorithm, $image] = explode(PHP_EOL . PHP_EOL, $input);

        $image = Image::createFromString($image);
        $imageEnhancer = new ImageEnhancer($algorithm);

        $image = $imageEnhancer->enhance($image);
        $image = $imageEnhancer->enhance($image);

        return $image->countLights();
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));
    }
}
