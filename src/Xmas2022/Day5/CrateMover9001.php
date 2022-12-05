<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day5;

class CrateMover9001 extends CrateMover9000
{
    public function run(): void
    {
        foreach ($this->getInstructions() as $instruction) {
            $counter = $instruction->quantity;

            $crates = [];
            while ($counter--) {
                $crates[] = array_pop($this->stacks[$instruction->from]);
            }

            foreach (array_reverse($crates) as $crate) {
                $this->stacks[$instruction->to][] = $crate;
            }
        }
    }
}
