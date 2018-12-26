<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day17;

use Jean85\AdventOfCode\SolutionInterface;

class Day17Solution implements SolutionInterface
{
    public function solve()
    {
        $underground = new Underground(ClayInput::getInput());

        $turn = 0;
        do {
            if ($turn++ > 700) {
                file_put_contents(__DIR__ . '/siterp.txt', $underground->getActualSituation());
            }
            
            if ($turn % 100 === 0) {
                echo  $turn . PHP_EOL;
            }
        } while ($underground->flow());

        return $underground->countWetSpots();
    }
}
