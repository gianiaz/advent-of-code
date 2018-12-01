<?php

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

require_once __DIR__ . '/vendor/autoload.php';

$day = (int) $argv[1];

if (! is_int($day)) {
    throw new \InvalidArgumentException('Invalid day: ' . $day);
}

$year = (int) $argv[2];

if (! is_int($year) || $year < 2010) {
    $year = (int)(new \DateTime('-11 months'))->format('Y');
}

$className = \sprintf('\Jean85\AdventOfCode\Xmas%d\Day%d\Day%dSolution', $year, $day, $day);
if (! class_exists($className)) {
    throw new \InvalidArgumentException('Missing solution class: ' . $className);
}

/** @var SolutionInterface $solution */
$solution = new $className();

echo 'Solution for day ' . $day . PHP_EOL . PHP_EOL;

echo $solution->solve();

echo PHP_EOL;
echo PHP_EOL;

if ($solution instanceof SecondPartSolutionInterface) {
    echo 'Second part of the solution for day ' . $day . PHP_EOL . PHP_EOL;

    echo $solution->solveSecondPart();
}

echo PHP_EOL;
