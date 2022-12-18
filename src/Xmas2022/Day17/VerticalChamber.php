<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

class VerticalChamber
{
    /** @var string[][] */
    private array $map;
    private int $rockCount;
    /** @var array<int, int> */
    private array $yReachedAtRock;
    private int $maxY;
    private JetStreamGenerator $jetStreamGenerator;
    private RockGenerator $rockGenerator;

    public function __construct(private readonly string $jetStream)
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->map = [];
        $this->yReachedAtRock = [];
        $this->rockCount = 0;
        $this->maxY = -1;
        $this->jetStreamGenerator = new JetStreamGenerator($this->jetStream);
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

        ++$this->rockCount;
        $this->maxY = max(array_keys($this->map));
        $this->yReachedAtRock[$this->maxY] ??= $this->rockCount;
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

    /**
     * @return array{int, int} Starting rock and rock length of the pattern
     */
    public function findPatternSize(): array
    {
        $rocks = 0;
        do {
            $this->simulateNextRock();
        } while (++$rocks < 2000);

        $patternStart = $this->findPatternStart();
        $patternLength = $this->findPatternLength();
        $patternStartsAfterRock = $this->yReachedAtRock[$patternStart];

        return [
            $patternStartsAfterRock,
            $this->yReachedAtRock[$patternStart + $patternLength] - $patternStartsAfterRock,
        ];
    }

    public function findPatternStart(): int
    {
        $reverseMap = strrev($this->drawMap());
        $patternStart = 0;

        do {
            $offset = 10 * ++$patternStart;
            $needle = substr($reverseMap, $offset, 10 * 10);
            $patternFound = strpos($reverseMap, $needle, $offset + 10 * 10);
        } while (false === $patternFound);

        return $patternStart - 1;
    }

    public function findPatternLength(): int
    {
        $drawnMap = $this->drawMap();

        $offset = $this->findPatternStart();
        $patternLength = 10;

        do {
            $needle = substr($drawnMap, $offset * 10, ++$patternLength * 10);
            $initialPatternRepetitions ??= substr_count($drawnMap, $needle) - 1; // subtracting 1 due to incomplete pattern at the end
        } while ($initialPatternRepetitions <= substr_count($drawnMap, $needle));

        return --$patternLength;
    }
}
