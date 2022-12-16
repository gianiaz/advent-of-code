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

        $this->currentValve = $this->valves['AA'];
    }

    public function getMaximumReleasedPressure(): int
    {
        $maximumRelease = 0;
        $functioningValves = array_filter($this->valves, fn (Valve $v) => $v->flowRate);
        $allCombinations = new Permutations($functioningValves);
        
        foreach ($allCombinations->generator() as $i => $combination) {
            if (0 === $i % 100000) {
                echo 'Combination ' . $i . PHP_EOL;
            }
            foreach ($combination as $step) {
                try {
                    $this->stepTo($step);
                } catch (\RuntimeException) {
                    break;
                }

                if ($this->remainingMinutes > 0 && $this->currentValve->flowRate > 0) {
                    $this->openCurrentValve();
                }
            }

            while ($this->remainingMinutes > 0) {
                $this->tick();
            }

            $maximumRelease = max($maximumRelease, $this->releasedPressure);
            $this->reset();
        }

        return $maximumRelease;
    }

    public function stepTo(Valve $nextValve): void
    {
        $distance = $this->findDistance($this->currentValve, $nextValve);

        do {
            $this->tick();
        } while (--$distance);

        $this->currentValve = $nextValve;
    }

    private function tick(): void
    {
        if ($this->remainingMinutes < 1) {
            throw new \RuntimeException('No more minutes');
        }

        --$this->remainingMinutes;
        $this->releasedPressure += $this->releaseFlow;
    }

    public function openCurrentValve(): void
    {
        $this->tick();
        $this->releaseFlow += $this->currentValve->flowRate;
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

    public function getCurrentValve(): Valve
    {
        return $this->currentValve;
    }

    public function getMinute(): int
    {
        return 30 - $this->remainingMinutes;
    }

    public function getRemainingMinutes(): int
    {
        return $this->remainingMinutes;
    }

    public function getReleasedPressure(): int
    {
        return $this->releasedPressure;
    }

    public function getReleaseFlow(): int
    {
        return $this->releaseFlow;
    }

    private function reset(): void
    {
        $this->currentValve = $this->getValve('AA');
        $this->remainingMinutes = 30;
        $this->releasedPressure = 0;
        $this->releaseFlow = 0;
    }
}
