<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day17;

class Underground
{
    public const CLAY = '#';
    public const SAND = '.';
    public const STILL_WATER = '~';
    public const FLOWING_WATER = '|';

    /** @var string[][] */
    private $map;

    /** @var int */
    private $minX = 500;

    /** @var int */
    private $minY = 0;

    /** @var int */
    private $maxX = 500;

    /** @var int */
    private $maxY = 0;

    /**
     * Underground constructor.
     *
     * @param int[] $input
     */
    public function __construct(array $input)
    {
        $this->initMap($input);
    }

    public function flow(int $x = 500, int $y = 0): bool
    {
        // flow down
        while ($this->contains($x, $y + 1, [self::SAND, self::FLOWING_WATER])) {
            ++$y;
            if ($y > $this->maxY) {
                return false;
            }

            $this->map[$y][$x] = self::FLOWING_WATER;
        }

        if ($this->hasClayOnBothSides($x, $y)) {
            return $this->fillToTheLeft($x, $y) || $this->fillToTheRight($x, $y) || $this->putTheFinalStillWater($x, $y);
        }

        return $this->overflowToTheLeft($x, $y) || $this->overflowToTheRight($x, $y);
    }

    private function hasClayOnBothSides(int $startX, int $y): bool
    {
        $x = $startX;
        while ($this->contains(--$x, $y, [self::SAND, self::FLOWING_WATER, self::STILL_WATER])) {
            if ($this->contains($x, $y + 1, [self::FLOWING_WATER, self::SAND])) {
                return false;
            }
        }

        if (! $this->contains($x, $y, [self::CLAY])) {
            return false;
        }

        $x = $startX;
        while ($this->contains(++$x, $y, [self::SAND, self::FLOWING_WATER, self::STILL_WATER])) {
            if ($this->contains($x, $y + 1, [self::FLOWING_WATER, self::SAND])) {
                return false;
            }
        }

        return $this->contains($x, $y, [self::CLAY]);
    }

    private function fillToTheLeft(int $x, int $y): bool
    {
        if ($this->contains($x - 1, $y, [self::CLAY])) {
            return false;
        }

        while ($this->contains(--$x, $y, [self::SAND, self::FLOWING_WATER])) {
            $this->map[$y][$x] = self::FLOWING_WATER;
        }

        if ($this->contains($x, $y, [self::CLAY, self::STILL_WATER])) {
            $this->map[$y][$x + 1] = self::STILL_WATER;

            return true;
        }

        // otherwise it's sand, overflow
        $this->map[$y][$x] = self::FLOWING_WATER;

        return false;
    }

    private function fillToTheRight(int $x, int $y): bool
    {
        if ($this->contains($x + 1, $y, [self::CLAY])) {
            return false;
        }

        while ($this->contains(++$x, $y, [self::SAND, self::FLOWING_WATER])) {
            $this->map[$y][$x] = self::FLOWING_WATER;
        }

        if ($this->contains($x, $y, [self::CLAY, self::STILL_WATER])) {
            $this->map[$y][$x - 1] = self::STILL_WATER;

            return true;
        }

        // otherwise it's sand, overflow
        $this->map[$y][$x] = self::FLOWING_WATER;

        return false;
    }

    private function putTheFinalStillWater(int $x, int $y): bool
    {
        if ($this->contains($x, $y, [self::STILL_WATER, self::CLAY])) {
            $this->map[$y][$x] = self::STILL_WATER;

            return true;
        }

        throw new \RuntimeException('WTF');
    }

    private function overflowToTheLeft(int $x, int $y): bool
    {
        while ($this->contains($x, $y + 1, [self::CLAY, self::STILL_WATER]) && $this->contains($x, $y, [self::SAND, self::FLOWING_WATER])) {
            $this->map[$y][$x--] = self::FLOWING_WATER;
        }

        if ($this->contains($x, $y, [self::CLAY])) {
            return false;
        }

        $this->map[$y][$x] = self::FLOWING_WATER;

        return $this->flow($x, $y);
    }

    private function overflowToTheRight(int $x, int $y): bool
    {
        while ($this->contains($x, $y + 1, [self::CLAY, self::STILL_WATER]) && $this->contains($x, $y, [self::SAND, self::FLOWING_WATER])) {
            $this->map[$y][$x++] = self::FLOWING_WATER;
        }

        if ($this->contains($x, $y, [self::CLAY])) {
            return false;
        }

        $this->map[$y][$x] = self::FLOWING_WATER;

        return $this->flow($x, $y);
    }

    public function getActualSituation(): string
    {
        $situation = '';
        foreach (range($this->minY, $this->maxY) as $y) {
            foreach (range($this->minX - 1, $this->maxX + 1) as $x) {
                $situation .= $this->map[$y][$x] ?? self::SAND;
            }
            $situation .= PHP_EOL;
        }

        return $situation;
    }

    private function initMap(array $input): void
    {
        $this->map[0][500] = '+';

        foreach ($input as $coords) {
            $xCoords = $this->extractCoords($coords['x']);
            $yCoords = $this->extractCoords($coords['y']);

            $this->minX = min($this->minX, ...$xCoords);
            $this->minY = min($this->minY, ...$yCoords);
            $this->maxX = max($this->maxX, ...$xCoords);
            $this->maxY = max($this->maxY, ...$yCoords);

            foreach ($yCoords as $y) {
                foreach ($xCoords as $x) {
                    $this->map[$y][$x] = self::CLAY;
                }
            }
        }
    }

    /**
     * @param int|int[] $coord
     *
     * @return int[]
     */
    private function extractCoords($coord): array
    {
        if (\is_int($coord)) {
            return [$coord];
        }

        if (\is_array($coord)) {
            return range($coord[0], $coord[1]);
        }

        throw new \InvalidArgumentException('Unrecognized coords');
    }

    private function contains(int $x, int $y, array $possibleSigns): bool
    {
        if (! \array_key_exists($y, $this->map)) {
            return \in_array(self::SAND, $possibleSigns, true);
        }

        if (! \array_key_exists($x, $this->map[$y])) {
            return \in_array(self::SAND, $possibleSigns, true);
        }

        return \in_array($this->map[$y][$x], $possibleSigns, true);
    }
}
