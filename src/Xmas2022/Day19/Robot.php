<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day19;

class Robot
{
    private int $robotCount = 0;
    public int $collectedMaterial = 0;
    /** @var RequiredMaterial[] */
    public readonly array $recipe;

    public function __construct(
        public readonly Material $material,
        RequiredMaterial ...$recipe,
    ) {
        $this->recipe = $recipe;
    }

    public function getRobotCount(): int
    {
        return $this->robotCount;
    }

    public function addRobot(): void
    {
        ++$this->robotCount;
    }
}
