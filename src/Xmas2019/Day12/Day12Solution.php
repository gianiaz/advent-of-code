<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day12;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day12Solution implements SolutionInterface, SecondPartSolutionInterface
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

    public function solveSecondPart(JupiterSimulator $simulator = null)
    {
        if ($simulator === null) {
            $simulator = new JupiterSimulator(
                new Moon(-6, -5, -8),
                new Moon(0, -3, -13),
                new Moon(-15, 10, -11),
                new Moon(-3, -8, 3)
            );
        }

        $x = $simulator->findRepetition('x');
        $y = $simulator->findRepetition('y');
        $z = $simulator->findRepetition('z');
        $minimumRepetitions = [
            $x,
            $y,
            $z,
        ];

        sort($minimumRepetitions);

        $max = $minimumRepetitions[2];
        $mcm = 0;

        do {
            $mcm += $max;
        } while ($mcm % $minimumRepetitions[0] !== 0 || $mcm % $minimumRepetitions[1] !== 0);

        return $mcm;
    }
}
