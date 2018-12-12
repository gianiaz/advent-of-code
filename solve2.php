<?php

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

require_once __DIR__ . '/vendor/autoload.php';

$game = new \Jean85\AdventOfCode\Xmas2018\Day9\SameMarbleGame(148, 7133900);

echo 'Solution: ' . $game->play();
