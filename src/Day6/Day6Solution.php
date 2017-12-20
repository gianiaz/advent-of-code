<?php

namespace Jean85\AdventOfCode\Day6;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day6Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const INPUT = [10, 3, 15, 10, 5, 15, 5, 15, 9, 2, 5, 8, 5, 2, 3, 6];
    /** @var int[] */
    private $banks;

    /** @var int */
    private $bankCount;

    /** @var int[][] */
    private $seenConfigurations;

    /**
     * Day4Solution constructor.
     * @param $input
     */
    public function __construct(array $input = self::INPUT)
    {
        $this->banks = $input;
        $this->bankCount = \count($this->banks);
        $this->seenConfigurations = [];
    }

    public function solve()
    {
        $steps = 0;
        do {
            $this->executeOneReassignment();
            ++$steps;
        } while ($this->currentConfigurationIsUnseen());

        return $steps;
    }

    public function executeOneReassignment(): array
    {
        $highestBlocks = max($this->banks);
        $bankToBeReassigned = \array_search($highestBlocks, $this->banks, true);
        $this->reassignBlocksFromBank($bankToBeReassigned);

        return $this->banks;
    }

    public function solveSecondPart()
    {
        $this->solve();
        $steps = 0;

        $bankState = $this->getBanks();

        do {
            $this->executeOneReassignment();
            ++$steps;
        } while ($this->getBanks() !== $bankState);

        return $steps;
    }

    /**
     * @return int[]
     */
    public function getBanks(): array
    {
        return $this->banks;
    }

    private function currentConfigurationIsUnseen(): bool
    {
        if (\in_array($this->banks, $this->seenConfigurations, true)) {
            return false;
        }

        $this->seenConfigurations[] = $this->banks;

        return true;
    }

    private function reassignBlocksFromBank(int $bankToBeReassigned): void
    {
        $blocksToBeReassigned = $this->banks[$bankToBeReassigned];
        $this->banks[$bankToBeReassigned] = 0;

        $iterator = $bankToBeReassigned + 1;

        do {
            $iterator %= $this->bankCount;
            ++$this->banks[$iterator];
            --$blocksToBeReassigned;
            ++$iterator;
        } while ($blocksToBeReassigned);
    }
}
