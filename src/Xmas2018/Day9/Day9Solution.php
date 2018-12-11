<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day9Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve()
    {
        return '';
        $marbleGame = new MarbleGame(418, 71339);

        return $marbleGame->play();
    }

    public function solveSecondPart()
    {
        $marbleGame = new MarbleGame(418, 7133900);

        return $marbleGame->play();
    }
}
