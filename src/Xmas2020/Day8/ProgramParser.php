<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day8;

class ProgramParser
{
    /**
     * @return Instruction[]
     */
    public static function parse(string $input): array
    {
        $program = [];
        foreach (explode("\n", $input) as $instruction) {
            $split = explode(' ', $instruction);
            $program[] = new Instruction($split[0], (int) $split[1]);
        }

        return $program;
    }
}
