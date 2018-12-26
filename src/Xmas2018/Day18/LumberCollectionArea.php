<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day18;

class LumberCollectionArea
{
    public const OPEN = '.';
    public const TREES = '|';
    public const LUMBERYARD = '#';

    /** @var string[][] */
    private $map;

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, $input) as $y => $row) {
            $this->map[$y] = str_split($row);
        }
    }

    public function getActualSituation(): string
    {
        $situation = [];
        foreach ($this->map as $row) {
            $situation[] = implode('', $row);
        }

        return implode(PHP_EOL, $situation);
    }

    public function getResourceValue(): int
    {
        $lumberyards = 0;
        $trees = 0;

        foreach ($this->map as $row) {
            foreach ($row as $area) {
                switch ($area) {
                    case self::LUMBERYARD:
                        $lumberyards++;
                        break;
                    case self::TREES:
                        $trees++;
                        break;
                }
            }
        }

        return $lumberyards * $trees;
    }

    public function tick(): void
    {
        $newMap = [];

        foreach ($this->map as $y => $row) {
            $newMap[$y] = [];
            foreach ($row as $x => $area) {
                $newMap[$y][$x] = $this->evolve($area, $x, $y);
            }
        }

        $this->map = $newMap;
    }

    private function evolve(string $areaType, int $x, int $y): string
    {
        $surrounding = $this->getSurroundingsOf($x, $y);

        switch ($areaType) {
            case self::OPEN:
                if ($this->contains($surrounding, self::TREES, 3)) {
                    return self::TREES;
                }

                return self::OPEN;
            case self::TREES:
                if ($this->contains($surrounding, self::LUMBERYARD, 3)) {
                    return self::LUMBERYARD;
                }

                return self::TREES;
            case self::LUMBERYARD:
                if ($this->contains($surrounding, self::TREES) && $this->contains($surrounding, self::LUMBERYARD)) {
                    return self::LUMBERYARD;
                }

                return self::OPEN;
            default:
                throw new \InvalidArgumentException('Unrecognized area: ' . $areaType);
        }
    }

    private function getSurroundingsOf(int $x, int $y): array
    {
        $surroundings = [
            $this->map[$y - 1][$x - 1] ?? null,
            $this->map[$y - 1][$x] ?? null,
            $this->map[$y - 1][$x + 1] ?? null,
            $this->map[$y][$x - 1] ?? null,
            $this->map[$y][$x + 1] ?? null,
            $this->map[$y + 1][$x - 1] ?? null,
            $this->map[$y + 1][$x] ?? null,
            $this->map[$y + 1][$x + 1] ?? null,
        ];

        return array_filter($surroundings);
    }

    private function contains(array $surrounding, string $filterBy, int $minCount = 1): bool
    {
        $filtered = \array_filter($surrounding, function (string $type) use ($filterBy) {
            return $type === $filterBy;
        });

        return \count($filtered) >= $minCount;
    }
}
