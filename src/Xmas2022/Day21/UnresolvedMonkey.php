<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day21;

class UnresolvedMonkey
{
    public function __construct(
        public readonly string $a,
        public readonly Operation $operation,
        public readonly string $b,
    ) {
    }
}
