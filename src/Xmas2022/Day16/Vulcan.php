<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day16;

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
        $solution = [
            $this->valves['DD'],
            $this->valves['BB'],
            $this->valves['JJ'],
            $this->valves['HH'],
            $this->valves['EE'],
            $this->valves['CC'],
        ];

        foreach ($solution as $step) {
            $this->stepTo($step->name);
            if ($this->currentValve->flowRate > 0) {
                $this->openCurrentValve();
            }
        }

        while ($this->remainingMinutes > 0) {
            $this->tick();
        }

        return $this->releasedPressure;
    }

    public function stepTo(string $valveName): void
    {
        $nextValve = $this->getValve($valveName);
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
        $distance = 1;
        $visitedValves = [$start->name => $start];
        $toVisit = $start->linkedValves;

        do {
            $newToVisit = [];
            foreach ($toVisit as $neighbour) {
                if ($neighbour->name === $target->name) {
                    return $distance;
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
}
