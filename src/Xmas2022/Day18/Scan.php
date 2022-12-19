<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day18;

class Scan
{
    /** @var Cube[][][] */
    private array $map = [];

    /** @var list<Cube> */
    private array $list = [];

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
        }
    }

    public function countFreeSides(): int
    {
        $total = 0;
        foreach ($this->list as $cube) {
            foreach ($cube->getNeighbours() as $neighbour) {
                if (! isset($this->map[$neighbour->x][$neighbour->y][$neighbour->z])) {
                    ++$total;
                }
            }
        }

        return $total;
    }
}
