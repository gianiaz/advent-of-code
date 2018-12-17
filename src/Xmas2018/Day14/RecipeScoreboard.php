<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day14;

class RecipeScoreboard
{
    /** @var int[] */
    private $recipes = [];

    /** @var int */
    private $firstElf;

    /** @var int */
    private $secondElf;

    public function __construct()
    {
        $this->recipes[] = 3;
        $this->recipes[] = 7;

        $this->firstElf = 0;
        $this->secondElf = 1;
    }

    public function tick()
    {
        //add new recipes
        $newRecipeTotal = $this->recipes[$this->firstElf] . $this->recipes[$this->secondElf];
        $newSum = \array_sum(str_split($newRecipeTotal));
        $newRecipes = \str_split((string) $newSum);
        foreach ($newRecipes as $newRecipe) {
            $this->recipes[] = $newRecipe;
        }

        $this->firstElf = $this->moveElf($this->firstElf);
        $this->secondElf = $this->moveElf($this->secondElf);
    }

    public function getActualSituation(): string
    {
        $situation = '';

        foreach ($this->recipes as $position => $recipe) {
            if ($position === $this->firstElf) {
                $situation .= sprintf('(%s)', $recipe);
            } elseif ($position === $this->secondElf) {
                $situation .= sprintf('[%s]', $recipe);
            } else {
                $situation .= sprintf(' %s ', $recipe);
            }
        }

        return $situation;
    }

    public function getRecipes(): array
    {
        return $this->recipes;
    }

    private function moveElf(int $currentElfPosition): int
    {
        $stepsForward = $currentElfPosition + 1 + $this->recipes[$currentElfPosition];

        return $stepsForward % \count($this->recipes);
    }
}
