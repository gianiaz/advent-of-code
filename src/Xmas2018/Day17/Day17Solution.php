<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day17;

use Jean85\AdventOfCode\SolutionInterface;

class Day17Solution implements SolutionInterface
{
    public function solve()
    {
        $underground = new Underground(ClayInput::getInput());

        do {
        } while ($underground->flow());

        return $underground->countWetSpots();
    }
}
