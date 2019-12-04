<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day4;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day4Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const RANGE_MIN = 284639;
    private const RANGE_MAX = 748759;

    public function solve()
    {
        $password = new Password(self::RANGE_MIN);

        return $this->countValidPasswords($password, self::RANGE_MAX);
    }

    public function solveSecondPart()
    {
        $password = new StricterPassword(self::RANGE_MIN);

        return $this->countValidPasswords($password, self::RANGE_MAX);
    }

    private function countValidPasswords(Password $start, int $max): int
    {
        $validCount = 0;
        $password = $start;

        do {
            if ($password->isValid()) {
                ++$validCount;
            }

            $password = $password->next();
        } while ($password->getPassword() <= $max);

        return $validCount;
    }
}
