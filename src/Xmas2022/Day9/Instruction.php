<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day9;

class Instruction
{
    public readonly Direction $direction;
    public readonly int $distance;

    public function __construct(string $input)
    {
        if (1 !== \Safe\preg_match('/^([RLUD]) (\d+)$/', trim($input), $matches)) {
            throw new \InvalidArgumentException('Unable to parse instruction: ' . $input);
        }

        $this->direction = Direction::from($matches[1]);
        $this->distance = (int) $matches[2];
    }
}
