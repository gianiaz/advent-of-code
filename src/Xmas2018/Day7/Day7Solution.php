<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day7;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day7Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var string[] */
    private $input;

    /** @var Graph */
    private $graph;

    /** @var int */
    private $baseWorkerTime;

    /** @var int */
    private $workerCount;

    /**
     * Day7Solution constructor.
     */
    public function __construct(array $input = null, int $workerCount = 5, int $baseWorkerTime = 60)
    {
        $this->workerCount = $workerCount;
        $this->baseWorkerTime = $baseWorkerTime;

        $this->input = $input ?? $this->getInput();
    }

    public function solve()
    {
        $this->prepareGraph();
        $solution = '';

        while ($nextStep = $this->graph->getFirstAvailable()) {
            $nextStep->setComplete();

            $solution .= $nextStep->getName();

            $nextStep->setObsolete();
        }

        return $solution;
    }

    public function solveSecondPart()
    {
        $this->prepareGraph();

        for ($i = 0; $i < $this->workerCount; ++$i) {
            $workforce[] = new Worker($this->baseWorkerTime);
        }

        return $this->run($workforce);
    }

    /**
     * @param Worker[] $workforce
     */
    private function run(array $workforce): int
    {
        $timeSpent = 0;
        do {
            $this->dispatchSteps($workforce);

            foreach ($workforce as $id => $worker) {
                $worker->tick();
            }

            ++$timeSpent;
        } while (! $this->graph->areAllComplete());

        return $timeSpent;
    }

    /**
     * @param Worker[] $workforce
     */
    private function dispatchSteps(array $workforce): void
    {
        $nextStep = $this->graph->getFirstAvailable();
        if ($nextStep === null) {
            return;
        }

        foreach ($workforce as $worker) {
            if ($worker->isFree()) {
                $nextStep->setObsolete();
                $worker->setCurrentStep($nextStep);

                $nextStep = $this->graph->getFirstAvailable();
                if ($nextStep === null) {
                    return;
                }
            }
        }
    }

    private function getInput(): array
    {
        return [
            ['S', 'V'],
            ['J', 'T'],
            ['N', 'Q'],
            ['O', 'H'],
            ['I', 'C'],
            ['Y', 'R'],
            ['K', 'B'],
            ['A', 'C'],
            ['B', 'D'],
            ['W', 'T'],
            ['E', 'V'],
            ['Q', 'L'],
            ['U', 'P'],
            ['R', 'C'],
            ['V', 'M'],
            ['X', 'P'],
            ['G', 'T'],
            ['T', 'Z'],
            ['Z', 'M'],
            ['F', 'C'],
            ['M', 'L'],
            ['D', 'C'],
            ['H', 'L'],
            ['L', 'P'],
            ['P', 'C'],
            ['S', 'Q'],
            ['M', 'P'],
            ['S', 'T'],
            ['U', 'T'],
            ['X', 'H'],
            ['Q', 'G'],
            ['Y', 'U'],
            ['H', 'C'],
            ['O', 'F'],
            ['S', 'P'],
            ['B', 'E'],
            ['S', 'D'],
            ['R', 'X'],
            ['Z', 'D'],
            ['J', 'C'],
            ['Z', 'F'],
            ['K', 'T'],
            ['T', 'H'],
            ['E', 'H'],
            ['D', 'L'],
            ['O', 'A'],
            ['V', 'T'],
            ['V', 'X'],
            ['Q', 'X'],
            ['O', 'K'],
            ['L', 'C'],
            ['W', 'H'],
            ['I', 'T'],
            ['M', 'H'],
            ['V', 'G'],
            ['K', 'P'],
            ['E', 'X'],
            ['V', 'C'],
            ['Y', 'W'],
            ['J', 'G'],
            ['B', 'C'],
            ['B', 'Z'],
            ['K', 'R'],
            ['Y', 'V'],
            ['X', 'G'],
            ['J', 'K'],
            ['A', 'M'],
            ['T', 'M'],
            ['W', 'D'],
            ['G', 'F'],
            ['A', 'B'],
            ['W', 'F'],
            ['Y', 'P'],
            ['B', 'V'],
            ['N', 'G'],
            ['J', 'H'],
            ['S', 'L'],
            ['A', 'R'],
            ['X', 'D'],
            ['Y', 'M'],
            ['H', 'P'],
            ['F', 'D'],
            ['S', 'G'],
            ['K', 'C'],
            ['W', 'Z'],
            ['A', 'Z'],
            ['O', 'Y'],
            ['U', 'C'],
            ['X', 'M'],
            ['Y', 'A'],
            ['F', 'P'],
            ['J', 'Y'],
            ['R', 'G'],
            ['Y', 'Q'],
            ['D', 'P'],
            ['O', 'U'],
            ['O', 'I'],
            ['E', 'L'],
            ['G', 'Z'],
            ['T', 'F'],
            ['Q', 'F'],
        ];
    }

    private function prepareGraph(): void
    {
        $this->graph = new Graph();

        foreach ($this->input as $data) {
            $nextStep = $this->graph->getStep($data[1]);
            $prevStep = $this->graph->getStep($data[0]);

            $nextStep->addDepends($prevStep);
        }
    }
}
