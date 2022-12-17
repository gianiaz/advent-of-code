<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

class VerticalChamber
{
    /** @var string[][] */
    private array $map = [];
    private int $maxY = -1;
    private JetStreamGenerator $jetStreamGenerator;
    private RockGenerator $rockGenerator;

    public function __construct(string $jetStream)
    {
        $this->jetStreamGenerator = new JetStreamGenerator($jetStream);
        $this->rockGenerator = new RockGenerator();
    }

    public function getMaxY(): int
    {
        return $this->maxY + 1;
    }

    public function simulateNextRock(): void
    {
        $rock = $this->rockGenerator->next(new Coordinates(2, $this->maxY + 4));

        do {
            $this->pushByJetStream($rock);
            $hasFallen = $this->fallDownWard($rock);
        } while ($hasFallen);

        $this->addToMap($rock);
    }

    public function drawMap(): string
    {
        $result = '';
        for ($y = $this->maxY; $y >= 0; --$y) {
            $result .= '|';
            for ($x = 0; $x < 7; ++$x) {
                $result .= $this->map[$y][$x] ?? '.';
            }

            $result .= '|' . PHP_EOL;
        }

        $result .= '+-------+';

        return $result;
    }

    private function addToMap(Rock $rock): void
    {
        foreach ($rock->getShape() as $piece) {
            $this->map[$piece->y][$piece->x] = '#';
        }

        $this->maxY = max(array_keys($this->map));
    }

    private function pushByJetStream(Rock $rock): void
    {
        $jetStream = $this->jetStreamGenerator->next();

        if ($this->canFollowJetStream($jetStream, $rock)) {
            $rock->push($jetStream);
        }
    }

    private function fallDownWard(Rock $rock): bool
    {
        foreach ($rock->getShape() as $piece) {
            if ($this->hasCollision($piece->withIncrease(0, -1))) {
                return false;
            }
        }

        $rock->fallDown();

        return true;
    }

    private function canFollowJetStream($jetStream, Rock $rock): bool
    {
        foreach ($rock->getShape() as $piece) {
            if ($this->hasCollision($piece->withIncrease($jetStream, 0))) {
                return false;
            }
        }

        return true;
    }

    private function hasCollision(Coordinates $location): bool
    {
        if ($location->x > 6) {
            return true;
        }

        if ($location->x < 0) {
            return true;
        }

        if ($location->y < 0) {
            return true;
        }

        return isset($this->map[$location->y][$location->x]);
    }
}
