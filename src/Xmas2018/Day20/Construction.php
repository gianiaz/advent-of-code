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
        $this->instructions = $instructions;
    }

    public function getTextualMap(): string
    {
        if (empty($this->map)) {
            foreach ($this->possiblePaths as $path) {
                $this->followPath($path);
            }

            $this->map[0][0] = self::CENTER;
        }

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

        return $this->navigateMapAndGetMaxDistance($mapDistance);
    }

    private function navigateMapAndGetMaxDistance(array &$mapDistance, int $x = 0, int $y = 0): int
    {
        $currentDistance = $mapDistance[$y][$x];
        $possibleDistances = [
            $currentDistance,
        ];

        if ($mapDistance[$y][$x + 1] ?? false) {
            // door open
            if ($mapDistance[$y][$x + 2] === self::ROOM || $mapDistance[$y][$x + 2] > ($currentDistance + 1)) {
                $mapDistance[$y][$x + 2] = $currentDistance + 1;
                $possibleDistances[] = $this->navigateMapAndGetMaxDistance($mapDistance, $x + 2, $y);
            }
        }

        if ($mapDistance[$y][$x - 1] ?? false) {
            // door open
            if ($mapDistance[$y][$x - 2] === self::ROOM || $mapDistance[$y][$x - 2] > ($currentDistance - 1)) {
                $mapDistance[$y][$x - 2] = $currentDistance + 1;
                $possibleDistances[] = $this->navigateMapAndGetMaxDistance($mapDistance, $x - 2, $y);
            }
        }

        if ($mapDistance[$y + 1][$x] ?? false) {
            // door open
            if ($mapDistance[$y + 2][$x] === self::ROOM || $mapDistance[$y + 2][$x] > ($currentDistance + 1)) {
                $mapDistance[$y + 2][$x] = $currentDistance + 1;
                $possibleDistances[] = $this->navigateMapAndGetMaxDistance($mapDistance, $x, $y + 2);
            }
        }

        if ($mapDistance[$y - 1][$x] ?? false) {
            // door open
            if ($mapDistance[$y - 2][$x] === self::ROOM || $mapDistance[$y - 2][$x] > ($currentDistance - 1)) {
                $mapDistance[$y - 2][$x] = $currentDistance + 1;
                $possibleDistances[] = $this->navigateMapAndGetMaxDistance($mapDistance, $x, $y - 2);
            }
        }

        return max($possibleDistances);
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
        $this->possiblePaths = $this->extractPaths($this->instructions);
    }

    /**
     * @return string[]
     */
    private function extractPaths(string $instructions, string $previousPath = ''): array
    {
        $finalPaths = [];
        $path = $previousPath;
        $i = 0;
        $currentStep = '';
        $openParenthesis = 0;
        $openBranches = [];

        while ($char = $instructions[$i++] ?? false) {
            if ($openParenthesis > 0) {
                switch ($char) {
                    case '|':
                        if ($openParenthesis === 1) {
                            $openBranches[] = $currentStep;
                            $currentStep = '';
                        } else {
                            $currentStep .= $char;
                        }
                        break;
                    case ')':
                        if ($openParenthesis > 1) {
                            $currentStep .= $char;
                        }
                        --$openParenthesis;
                        break;
                    case '(':
                        $openParenthesis++;
                        // no break
                    default:
                        $currentStep .= $char;
                }

                if ($openParenthesis === 0) {
                    $openBranches[] = $currentStep;
                    foreach ($openBranches as $openBranch) {
                        foreach ($this->extractPaths($openBranch . substr($instructions, $i), $path) as $branchedPath) {
                            $finalPaths[] = $branchedPath;
                        }
                    }

                    return $finalPaths;
                }

                continue;
            }

            switch ($char) {
                case '^':
                    break;
                case '|':
                    break;
                case '(':
                    $path .= $currentStep;
                    ++$openParenthesis;
                    $currentStep = '';
                    break;
                case ')':
                    throw new \RuntimeException('WTF');
                case '$':
                    $path .= $currentStep;
                    break;
                default:
                    $currentStep .= $char;
            }
        }

        $finalPaths[] = $path;

        return $finalPaths;
    }

    private function followPath(string $path): void
    {
        $x = 0;
        $y = 0;
        foreach (str_split($path) as $step) {
            switch ($step) {
                case 'N':
                    $this->map[++$y][$x] = self::DOOR_H;
                    $this->map[++$y][$x] = self::ROOM;
                    break;
                case 'S':
                    $this->map[--$y][$x] = self::DOOR_H;
                    $this->map[--$y][$x] = self::ROOM;
                    break;
                case 'E':
                    $this->map[$y][++$x] = self::DOOR_V;
                    $this->map[$y][++$x] = self::ROOM;
                    break;
                case 'W':
                    $this->map[$y][--$x] = self::DOOR_V;
                    $this->map[$y][--$x] = self::ROOM;
                    break;
                default:
                    throw new \InvalidArgumentException('Unrecognized step: ' . $step);
            }
        }
    }
}
