<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day19;

class RequiredMaterial
{
    public function __construct(
        public readonly Material $material,
        public readonly int $qty,
    ) {
    }
}
