<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day17;

class Underground
{
    public const CLAY = '#';
    public const SAND = '.';
    public const STILL_WATER = '~';
    public const FLOWED_WATER = '|';

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

    public function flow(): bool
    {
        $x = 500;
        $y = 0;

        // flow down
        while ($this->contains($x, $y + 1, [self::SAND, self::FLOWED_WATER])) {
            $y++;
            if ($y > $this->maxY) {
                return false;
            }

            $this->map[$y][$x] = self::FLOWED_WATER;
        }
        
        $originalFlowX = $x;

        if ($this->contains($x, $y + 1, [self::STILL_WATER])) {
            $y++;
            // flow left
            while ($this->contains($x, $y, [self::STILL_WATER])) {
                $x--;
            }
        }

        $this->map[$y][$x] = self::STILL_WATER;

        return true;
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
