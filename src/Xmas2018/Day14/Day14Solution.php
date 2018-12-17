<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day14;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day14Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private $input;

    public function __construct($input = 890691)
    {
        $this->input = $input;
    }

    public function solve()
    {
        $scoreboard = new RecipeScoreboard();

        do {
            $scoreboard->tick();
        } while (\count($scoreboard->getRecipes()) < 10 + $this->input);

        return implode('', \array_slice($scoreboard->getRecipes(), $this->input, 10));
    }

    public function solveSecondPart()
    {
        $scoreboard = new RecipeScoreboard((string) $this->input);

        try {
            do {
                $scoreboard->tick();
            } while (true);
        } catch (\RuntimeException $exception) {
        }

        return \count($scoreboard->getRecipes()) - \strlen((string) $this->input) + 1;
    }
}
