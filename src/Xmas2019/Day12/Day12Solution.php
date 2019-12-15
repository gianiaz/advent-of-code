<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day12;

use Jean85\AdventOfCode\SolutionInterface;

class Day12Solution implements SolutionInterface
{
    public function solve()
    {
        $simulator = new JupiterSimulator(
            new Moon(-6, -5, -8),
            new Moon(0, -3, -13),
            new Moon(-15, 10, -11),
            new Moon(-3, -8, 3)
        );

        $iterations = 1000;
        while ($iterations--) {
            $simulator->tick();
        }

        return $simulator->getTotalEnergy();
    }
}
