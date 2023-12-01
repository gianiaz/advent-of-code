<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day16;

use drupol\phpermutations\Generators\Permutations;

class Vulcan
{
    /** @var Valve */
    private array $valves = [];
    private Valve $currentValve;
    private int $remainingMinutes = 30;
    private int $releasedPressure = 0;
    private int $releaseFlow = 0;
    private $memoizedStates;

    public function __construct(string $input)
    {
        $tempValveMap = [];
        foreach (explode(PHP_EOL, $input) as $instruction) {
            if (1 !== \Safe\preg_match('/Valve ([A-Z]+) has flow rate=(\d+); tunnels? leads? to valves? ([A-Z, ]+)/', $instruction, $matches)) {
                throw new \InvalidArgumentException('Unable to parse: ' . $instruction);
            }

            $tempValveMap[$matches[1]] = [(int) $matches[2], $matches[3]];
        }

        foreach ($tempValveMap as $name => $valveDescription) {
            $this->valves[$name] = new Valve($name, $valveDescription[0]);
        }

        foreach ($tempValveMap as $name => $valveDescription) {
            foreach (explode(', ', $valveDescription[1]) as $neighbour) {
                $this->valves[$name]->addNeighbourValve($this->valves[$neighbour]);
            }
        }

        $currentValve = $this->valves['AA'];
    }

    public function getMaximumReleasedPressure(): int
    {
        $maximumRelease = 0;
        $functioningValves = array_filter($this->valves, fn(Valve $v) => $v->flowRate);
        $allCombinations = new Permutations($functioningValves);

        foreach ($allCombinations->generator() as $i => $combination) {
            if (0 === $i % 100000) {
                echo 'Combination ' . $i . PHP_EOL;
            }

            $state = new State($this->getValve('AA'));
            $state = $this->play($state, ...$combination);
            $state->stay();

            $maximumRelease = max($maximumRelease, $state->releasedPressure);
        }

        return $maximumRelease;
    }

    private function play(State $state, Valve ...$steps): State
    {
        if ($state->remainingMinutes === 0) {
            return $state;
        }

        $cacheKeySteps = Valve::cacheKey(...$steps);
        $cacheKeyState = $state->__toString();
        if (isset($this->memoizedStates[$cacheKeySteps][$cacheKeyState])) {
            return $this->memoizedStates[$cacheKeySteps][$cacheKeyState];
        }

        $state = clone $state;

        if (count($steps) === 0) {
            return $state;
        }

        $lastStep = array_pop($steps);
        $state = clone $this->play($state, ...$steps);

        if ($state->remainingMinutes === 0) {
            return $state;
        }

        if ($state->currentValveShouldBeOpened()) {
            $state->openCurrentValve();
        }

        $state->moveTo($lastStep, $this->findDistance($state->currentValve, $lastStep));

        return $this->memoizedStates[$cacheKeySteps][$cacheKeyState] = clone $state;
    }

    public function stepTo(Valve $nextValve): void
    {
        $distance = $this->findDistance($currentValve, $nextValve);

        do {
            $this->tick();
        } while (--$distance);

        $currentValve = $nextValve;
    }

    public function findDistance(Valve $start, Valve $target): int
    {
        if (isset($this->memoizedDistance[$start->name][$target->name])) {
            return $this->memoizedDistance[$start->name][$target->name];
        }

        $distance = 1;
        $visitedValves = [$start->name => $start];
        $toVisit = $start->linkedValves;

        do {
            $newToVisit = [];
            foreach ($toVisit as $neighbour) {
                if ($neighbour->name === $target->name) {
                    return $this->memoizedDistance[$start->name][$target->name] = $distance;
                }

                if (isset($visitedValves[$neighbour->name])) {
                    continue;
                }

                $visitedValves[$neighbour->name] = $neighbour;

                foreach ($neighbour->linkedValves as $next) {
                    if (! isset($visitedValves[$next->name])) {
                        $newToVisit[$next->name] = $next;
                    }
                }
            }

            ++$distance;
            $toVisit = $newToVisit;
        } while (true);
    }

    public function getValve(string $name): Valve
    {
        return $this->valves[$name]
            ?? throw new \InvalidArgumentException('Valve not found: ' . $name);
    }
}
