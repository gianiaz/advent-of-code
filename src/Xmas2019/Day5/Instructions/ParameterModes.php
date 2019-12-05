<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day5\Instructions;

use Jean85\AdventOfCode\Xmas2019\Day2\Memory;

class ParameterModes
{
    public const MODE_POSITION = 0;
    public const MODE_IMMEDIATE = 1;

    /** @var string */
    private $modes;

    public function __construct(Memory $memory)
    {
        $fullOpcode = str_pad((string) $memory->getCurrent(), 5, '0', STR_PAD_LEFT);
        $this->modes = array_reverse(str_split(substr($fullOpcode, 0, 3)));
    }

    public function isImmediate(int $parameter): bool
    {
        return $this->getMode($parameter) === self::MODE_IMMEDIATE;
    }

    public function getMode(int $parameter): int
    {
        return (int) $this->modes[$parameter - 1];
    }
}
