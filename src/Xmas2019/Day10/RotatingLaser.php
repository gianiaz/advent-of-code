<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day10;

class RotatingLaser
{
    /** @var MonitoringStation */
    private $monitoringStation;

    /** @var Asteroid */
    private $laserPosition;

    /** @var \SplObjectStorage<Asteroid> */
    private $asteroids;

    public function __construct(MonitoringStation $monitoringStation, array $asteroids)
    {
        $this->asteroids = new \SplObjectStorage();
        $this->monitoringStation = $monitoringStation;
        $this->monitoringStation->calculateBestPosition();
        $this->laserPosition = $this->monitoringStation->getBestPosition();

        foreach ($asteroids as $asteroid) {
            $this->asteroids->attach($asteroid);
        }
    }

    /**
     * @return Asteroid[]
     */
    public function getAsteroidsDestructionSweep(): array
    {
        $asteroids = $this->sortedAsteroids();

        $destroyedAsteroids = array_filter($asteroids, function (Asteroid $asteroid) {
            return $this->monitoringStation->isVisible(
                $this->laserPosition->getX(),
                $this->laserPosition->getY(),
                $asteroid
            );
        });

        foreach ($destroyedAsteroids as $asteroid) {
            $this->asteroids->detach($asteroid);
        }

        return $destroyedAsteroids;
    }

    /**
     * @return Asteroid[]
     */
    private function sortedAsteroids(): array
    {
        $asteroids = iterator_to_array($this->asteroids);

        usort($asteroids, function (Asteroid $a, Asteroid $b) {
            return $this->getAngle($a) <=> $this->getAngle($b);
        });

        return $asteroids;
    }

    private function getAngle(Asteroid $asteroid): float
    {
        $x = $this->laserPosition->getX() - $asteroid->getX();
        $y = $this->laserPosition->getY() - $asteroid->getY();

        return atan2($y, $x);
    }
}
