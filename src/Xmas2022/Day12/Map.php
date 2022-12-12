<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day12;

class Map
{
    /** @var int[][] */
    private array $map = [];

    private Coordinates $start;
    private Coordinates $end;
    /** @var int[][] */
    private array $cost = [];

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, trim($input)) as $y => $line) {
            foreach (str_split($line) as $x => $height) {
                switch ($height) {
                    case 'S':
                        $this->map[$y][$x] = 0;
                        $this->start = new Coordinates($x, $y);
                        break;
                    case 'E':
                        $this->map[$y][$x] = ord('z') - ord('a');
                        $this->end = new Coordinates($x, $y);
                        break;
                    default:
                        $this->map[$y][$x] = ord($height) - ord('a');
                }
            }
        }
    }

    public function findDistanceFromStart(): int
    {
        return $this->findPath($this->start);
    }

    public function findShorterDistanceFromLowestPoint(): int
    {
        $shortestPath = PHP_INT_MAX;

        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $height) {
                if ($height === 0) {
                    $shortestPath = min(
                        $shortestPath,
                        $this->findPath(new Coordinates($x, $y), $shortestPath)
                    );
                }
            }
        }

        return $shortestPath;
    }

    private function findPath(Coordinates $startingPoint, int $stopAfter = PHP_INT_MAX): int
    {
        $step = 0;
        $visiting = [$startingPoint];
        $this->cost = [];

        do {
            ++$step;

            if ($step > $stopAfter) {
                // give up!
                return PHP_INT_MAX;
            }

            $newVisiting = [];

            while ($current = array_pop($visiting)) {
                $currentHeight = $this->map[$current->y][$current->x];

                foreach ($current->getNeighbours() as $neighbour) {
                    if (! isset($this->map[$neighbour->y][$neighbour->x])) {
                        continue;
                    }

                    if (isset($this->cost[$neighbour->y][$neighbour->x])) {
                        continue;
                    }

                    if ($this->map[$neighbour->y][$neighbour->x] > (1 + $currentHeight)) {
                        continue;
                    }

                    if ($neighbour == $this->end) {
                        return $step;
                    }

                    $newVisiting[] = $neighbour;
                    $this->cost[$neighbour->y][$neighbour->x] = $step;
                }
            }

            if (! empty($visiting)) {
                throw new \RuntimeException('Something went wrong in the algorithm');
            }

            if (0 === $step % 10) {
                file_put_contents('round_' . $step, $this->printCost());
            }

            $visiting = $newVisiting;
        } while (! empty($visiting));

        return PHP_INT_MAX;
    }

    public function printHeight(): string
    {
        $result = '';

        foreach ($this->map as $row) {
            foreach ($row as $height) {
                $result .= sprintf(' %2d', $height);
            }
            $result .= PHP_EOL;
        }

        return $result;
    }

    public function printCost(): string
    {
        $result = '';

        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $height) {
                $result .= sprintf(' %3d', $this->cost[$y][$x] ?? 0);
            }
            $result .= PHP_EOL;
        }

        return $result;
    }
}
