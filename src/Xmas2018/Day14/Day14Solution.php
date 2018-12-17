<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day14;

use Jean85\AdventOfCode\SolutionInterface;

class Day14Solution implements SolutionInterface
{
    private $bestAfter;

    public function __construct(int $bestAfter = 890691)
    {
        $this->bestAfter = $bestAfter;
    }

    public function solve()
    {
        $scoreboard = new RecipeScoreboard();

        do {
            $scoreboard->tick();
        } while (\count($scoreboard->getRecipes()) < 10 + $this->bestAfter);

        return implode('', \array_slice($scoreboard->getRecipes(), $this->bestAfter, 10));
    }
}
