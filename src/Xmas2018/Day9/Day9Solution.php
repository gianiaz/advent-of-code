<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9;

use Jean85\AdventOfCode\SolutionInterface;

class Day9Solution implements SolutionInterface
{
    public function solve()
    {
        $marbleGame = new MarbleGame(418, 71339);

        return $marbleGame->play();
    }
}
