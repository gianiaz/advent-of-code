<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day16;

class State
{
    public int $remainingMinutes = 30;
    public int $releasedPressure = 0;
    /** @var string[] */
    public array $openValves = [];
    public int $releaseFlow = 0;

    public function __construct(
        public Valve $currentValve,
    ) {
    }

    public function __toString(): string
    {
        return implode('|', [
            'current:' . $this->currentValve->name,
            'minutes:' . $this->remainingMinutes,
            'open:' . implode(',', $this->openValves),
        ]);
    }

    public function currentValveShouldBeOpened(): bool
    {
        return $this->currentValve->flowRate > 0
            && ! in_array($this->currentValve->name, $this->openValves);
    }

    public function openCurrentValve(): void
    {
        $this->tick();

        if ($this->remainingMinutes === 0) {
            return;
        }

        $this->openValves[] = $this->currentValve->name;
        $this->releaseFlow += $this->currentValve->flowRate;
    }

    private function tick(): void
    {
        if ($this->remainingMinutes === 0) {
            return;
        }

        --$this->remainingMinutes;
        $this->releasedPressure += $this->releaseFlow;
    }

    public function moveTo(Valve $valve, int $distance): void
    {
        if ($distance > $this->remainingMinutes) {
            $this->stay();

            return;
        }

        $this->currentValve = $valve;
        $this->remainingMinutes -= $distance;
        $this->releasedPressure += $distance * $this->releaseFlow;
    }

    public function stay(): void
    {
        while ($this->remainingMinutes) {
            $this->tick();
        }
    }
}
