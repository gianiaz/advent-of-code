<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day5;

class Instruction
{
    public readonly int $stack;
    public readonly int $from;
    public readonly int $to;

    public function __construct(string $input)
    {
        $return = preg_match('/^move (\d+) from (\d+) to (\d+)$/', $input, $matches);

        if ($return !== 1) {
            throw new \InvalidArgumentException('Parsing error');
        }

        $this->stack = (int) $matches[1];
        $this->from = (int) $matches[2];
        $this->to = (int) $matches[3];
    }
}
