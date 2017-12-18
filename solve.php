<?php

require_once __DIR__ . '/vendor/autoload.php';

$day = (int) $argv[1];

if (! is_int($day)) {
    throw new \InvalidArgumentException('Invalid day: ' . $day);
}

$solution = new \Jean85\AdventOfCode\Day1\Day1Solution();

echo 'Solution for day ' . $day . PHP_EOL . PHP_EOL;

print_r($solution->solve());

echo PHP_EOL;
