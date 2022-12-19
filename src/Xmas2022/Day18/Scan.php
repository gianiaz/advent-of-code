<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day18;

class Scan
{
    /** @var Cube[][][] */
    private array $map = [];

    /** @var list<Cube> */
    private array $list = [];
    private int $maxX = 0;
    private int $maxY = 0;
    private int $maxZ = 0;

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, trim($input)) as $coordinates) {
            if (1 !== \Safe\preg_match('/(\d+),(\d+),(\d+)/', $coordinates, $matches)) {
                throw new \InvalidArgumentException('Unable to parse coordinates: ' . $coordinates);
            }

            $cube = new Cube(
                (int) $matches[1],
                (int) $matches[2],
                (int) $matches[3],
            );

            $this->map[$cube->x][$cube->y][$cube->z] = $cube;
            $this->list[] = $cube;
            $this->maxX = max($this->maxX, $cube->x + 1);
            $this->maxY = max($this->maxY, $cube->y + 1);
            $this->maxZ = max($this->maxZ, $cube->z + 1);
        }
    }

    public function countFreeSides(): int
    {
        $total = 0;
        foreach ($this->list as $cube) {
            foreach ($cube->getNeighbours() as $neighbour) {
                if (null === $this->getCubeFromMap($neighbour)) {
                    ++$total;
                }
            }
        }

        return $total;
    }

    public function countExternalSides(): int
    {
        $this->simulateVapor();

        $total = 0;
        foreach ($this->list as $cube) {
            foreach ($cube->getNeighbours() as $neighbour) {
                if ($this->getCubeFromMap($neighbour)?->isReachedBySteam) {
                    ++$total;
                }
            }
        }

        return $total;
    }

    private function getCubeFromMap(Cube $neighbour): ?Cube
    {
        return $this->map[$neighbour->x][$neighbour->y][$neighbour->z] ?? null;
    }

    private function simulateVapor(): void
    {
        $start = new Cube(0, 0, 0, true);

        $this->visitByVapor($start);
    }

    private function visitByVapor(Cube $vapor): void
    {
        foreach ($vapor->getNeighbours() as $neighbour) {
            if (
                $neighbour->x > $this->maxX
                || $neighbour->y > $this->maxY
                || $neighbour->z > $this->maxZ
            ) {
                continue;
            }

            if (null === $this->getCubeFromMap($neighbour)) {
                $this->map[$neighbour->x][$neighbour->y][$neighbour->z] = $neighbour->getVapor();
                $this->visitByVapor($neighbour);
            }
        }
    }
}
