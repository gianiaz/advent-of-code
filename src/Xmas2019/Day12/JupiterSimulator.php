<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day12;

class JupiterSimulator
{
    /** @var Moon[] */
    private $moons;

    public function __construct(Moon ...$moons)
    {
        foreach ($moons as $moon) {
            $this->moons[] = $moon;
        }
    }

    public function getSituation(): string
    {
        $situation = '';

        foreach ($this->moons as $moon) {
            $situation .= sprintf(
                'pos=<x=%d, y=%d, z=%d>, vel=<x=%d, y=%d, z=%d>',
                $moon->getPosition()->x,
                $moon->getPosition()->y,
                $moon->getPosition()->z,
                $moon->getVelocity()->x,
                $moon->getVelocity()->y,
                $moon->getVelocity()->z
            );

            $situation .= PHP_EOL;
        }

        return trim($situation);
    }

    public function tick(): void
    {
        $count = count($this->moons);
        foreach ($this->moons as $i => $moon) {
            for ($j = $i + 1; $j < $count; ++$j) {
                $moon->applyGravity($this->moons[$j]);
            }
        }

        foreach ($this->moons as $i => $moon) {
            $moon->applyVelocity();
        }
    }
}
