<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day4;

use Jean85\AdventOfCode\SolutionInterface;

class Day4Solution implements SolutionInterface
{
    public function solve()
    {
        return $this->countValidPasswords(284639, 748759);
    }

    private function countValidPasswords(int $min, int $max): int
    {
        $validCount = 0;
        $password = new Password($min);

        do {
            if ($password->isValid()) {
                ++$validCount;
            }

            $password = $password->next();
        } while ($password->getPassword() <= $max);

        return $validCount;
    }
}
