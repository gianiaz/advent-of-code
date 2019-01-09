<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day20;

class Construction
{
    private const CENTER = 'X';
    private const WALL = '#';
    private const DOOR_H = '-';
    private const DOOR_V = '|';
    private const ROOM = '.';
    /** @var string */
    private $instructions;

    /** @var string[] */
    private $possiblePaths;

    /** @var string[][] */
    private $map;

    public function __construct(string $instructions)
    {
        $this->instructions = \trim($instructions, '^$');
    }

    public function getTextualMap(): string
    {
        $this->map[0][0] = self::CENTER;

        $minY = min(\array_keys($this->map));
        $maxY = max(\array_keys($this->map));
        $minX = $maxX = 0;
        foreach ($this->map as $x => $row) {
            $minX = min($minX, ...\array_keys($row));
            $maxX = max($maxX, ...\array_keys($row));
        }

        $textualMap = '';
        foreach (range($maxY + 1, $minY - 1) as $y) {
            foreach (range($minX - 1, $maxX + 1) as $x) {
                $textualMap .= $this->map[$y][$x] ?? self::WALL;
            }
            $textualMap .= PHP_EOL;
        }

        return $textualMap;
    }

    public function getFurthestRoomDistance(): int
    {
        $mapDistance = $this->map;
        $mapDistance[0][0] = 0;

        $this->navigateMapAndGetMaxDistance($mapDistance);

        $maxDistance = 0;
        foreach ($mapDistance as $row) {
            foreach ($row as $distance) {
                if (\is_int($distance) && $distance > $maxDistance) {
                    $maxDistance = $distance;
                }
            }
        }

        return $maxDistance;
    }

    private function navigateMapAndGetMaxDistance(array &$mapDistance, int $x = 0, int $y = 0): ?int
    {
        $currentDistance = $mapDistance[$y][$x];
        $nextDistance = $currentDistance + 1;
        $possibleDistances = [];

        if ($mapDistance[$y][$x + 1] ?? false) {
            // door open
            if ($mapDistance[$y][$x + 2] === self::ROOM || $mapDistance[$y][$x + 2] > $nextDistance) {
                $mapDistance[$y][$x + 2] = $nextDistance;
                $possibleDistances[] = [$x + 2, $y];
            }
        }

        if ($mapDistance[$y][$x - 1] ?? false) {
            // door open
            if ($mapDistance[$y][$x - 2] === self::ROOM || $mapDistance[$y][$x - 2] > $nextDistance) {
                $mapDistance[$y][$x - 2] = $nextDistance;
                $possibleDistances[] = [$x - 2, $y];
            }
        }

        if ($mapDistance[$y + 1][$x] ?? false) {
            // door open
            if ($mapDistance[$y + 2][$x] === self::ROOM || $mapDistance[$y + 2][$x] > $nextDistance) {
                $mapDistance[$y + 2][$x] = $nextDistance;
                $possibleDistances[] = [$x, $y + 2];
            }
        }

        if ($mapDistance[$y - 1][$x] ?? false) {
            // door open
            if ($mapDistance[$y - 2][$x] === self::ROOM || $mapDistance[$y - 2][$x] > $nextDistance) {
                $mapDistance[$y - 2][$x] = $nextDistance;
                $possibleDistances[] = [$x, $y - 2];
            }
        }

        foreach ($possibleDistances as $possibleDistance) {
            $this->navigateMapAndGetMaxDistance($mapDistance, $possibleDistance[0], $possibleDistance[1]);
        }

        return $currentDistance;
    }

    /**
     * @return string[][]
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * @return string[]
     */
    public function getPossiblePaths(): array
    {
        return $this->possiblePaths;
    }

    public function processPaths(): void
    {
        $this->possiblePaths = \iterator_to_array($this->extractPaths($this->instructions));
    }

    private function extractPaths(string $instructions, string $previousPath = ''): \Generator
    {
        $firstOpenParenthesis = \strpos($instructions, '(');

        if (false === $firstOpenParenthesis) {
            foreach (explode('|', $instructions) as $singleBranch) {
                yield $previousPath . $singleBranch;
            }

            return;
        }
        $previousPath .= substr($instructions, 0, $firstOpenParenthesis);

        $firstClosedParenthesis = \strpos($instructions, ')', $firstOpenParenthesis);
        $branchesInstructions = \substr($instructions, $firstOpenParenthesis + 1, $firstClosedParenthesis - $firstOpenParenthesis - 1);
        $remainderInstructions = \substr($instructions, $firstClosedParenthesis + 1);

        foreach ($this->extractPaths($branchesInstructions, $previousPath) as $branch) {
            foreach ($this->extractPaths($remainderInstructions, $branch) as $newBranchedPath) {
                yield $newBranchedPath;
            }
        }
    }

    private function drawStep(string $step, int &$x, int &$y): void
    {
        switch ($step) {
            case 'N':
                if ($this->map[$y + 2][$x] ?? false) {
                    $y += 2;
                } else {
                    $this->map[++$y][$x] = self::DOOR_H;
                    $this->map[++$y][$x] = self::ROOM;
                }
                break;
            case 'S':
                if ($this->map[$y - 2][$x] ?? false) {
                    $y -= 2;
                } else {
                    $this->map[--$y][$x] = self::DOOR_H;
                    $this->map[--$y][$x] = self::ROOM;
                }
                break;
            case 'E':
                if ($this->map[$y][$x + 2] ?? false) {
                    $x += 2;
                } else {
                    $this->map[$y][++$x] = self::DOOR_V;
                    $this->map[$y][++$x] = self::ROOM;
                }
                break;
            case 'W':
                if ($this->map[$y][$x - 2] ?? false) {
                    $x -= 2;
                } else {
                    $this->map[$y][--$x] = self::DOOR_V;
                    $this->map[$y][--$x] = self::ROOM;
                }
                break;
            default:
                throw new \InvalidArgumentException('Unrecognized step: ' . $step);
        }
    }
}
