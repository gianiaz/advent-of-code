<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day17;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day17Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve()
    {
        ini_set('xdebug.max_nesting_level', '102400');
        $underground = new Underground(ClayInput::getInput());

        $underground->flow();

        file_put_contents(__DIR__ . '/sitrep.txt', $underground->getActualSituation());

        return $underground->countWetSpots();
    }

    public function solveSecondPart()
    {
        ini_set('xdebug.max_nesting_level', '102400');
        $underground = new Underground(ClayInput::getInput());

        $underground->flow();

        file_put_contents(__DIR__ . '/sitrep.txt', $underground->getActualSituation());

        return $underground->countRetainedWaterSpots();
    }
}
