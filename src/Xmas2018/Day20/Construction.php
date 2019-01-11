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

    /** @var Room[][] */
    private $map;

    public function __construct(string $instructions)
    {
        $this->instructions = \trim($instructions, '^$');
    }

    public function getTextualMap(): string
    {
        $minY = min(\array_keys($this->map));
        $maxY = max(\array_keys($this->map));
        $minX = $maxX = 0;
        foreach ($this->map as $x => $row) {
            $minX = min($minX, ...\array_keys($row));
            $maxX = max($maxX, ...\array_keys($row));
        }

        $textualMap = '';
        foreach (range($maxY + 1, $minY - 1) as $y) {
            $textualMap .= self::WALL;
            foreach (range($minX - 1, $maxX + 1) as $x) {
                if ($currentRoom = $this->map[$y][$x] ?? false) {
                    $textualMap .= $currentRoom->getWest() ? self::DOOR_V : self::ROOM;
                    $textualMap .= self::ROOM;
                } else {
                    $textualMap .= self::WALL . self::WALL;
                }
            }

            $textualMap .= self::WALL . PHP_EOL . self::WALL;

            foreach (range($minX - 1, $maxX + 1) as $x) {
                if ($currentRoom = $this->map[$y][$x] ?? false) {
                    $textualMap .= self::WALL;
                    $textualMap .= $currentRoom->getSouth() ? self::DOOR_H : self::WALL;
                } else {
                    $textualMap .= self::WALL . self::WALL;
                }
            }
            $textualMap .= self::WALL . PHP_EOL;
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
        $starting = $this->map[0][0] = new Room(0, 0);
        /** @var Scout[] $startingRooms */
        $startingRooms = [new Scout($starting)];
        /** @var Scout[] $scoutPositions */
        $scoutPositions = [new Scout($starting)];
        $startingRoomStack = new \SplStack();
        $scoutPositionStack = new \SplStack();
        $i = 0;

        while ($step = $this->instructions[$i++] ?? false) {
            /* @var string $step */
            switch ($step) {
                case '(':
                    $startingRoomStack->push($this->cloneScouts($startingRooms));
                    $scoutPositionStack->push($this->cloneScouts($scoutPositions));
                    $startingRooms = $this->cloneScouts($scoutPositions);
                    break;
                case '|':
                    foreach ($scoutPositions as $scout) {
                        $startingRooms[] = $scout;
                    }
                    $scoutPositions = $this->cloneScouts($startingRooms);
                    break;
                case ')':
                    $startingRooms = $startingRoomStack->pop();
                    $scoutPositions = $scoutPositionStack->pop();
                    break;
                default: // NSWE
                    foreach ($scoutPositions as $currentScout) {
                        $this->advanceScout($currentScout, $step);
                    }
            }
        }
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

        $firstClosedParenthesis = $this->findClosedParenthesis($instructions, $firstOpenParenthesis);
        $branchesInstructions = \substr($instructions, $firstOpenParenthesis + 1,
            $firstClosedParenthesis - $firstOpenParenthesis - 1);
        $remainderInstructions = \substr($instructions, $firstClosedParenthesis + 1);

        foreach ($this->extractPaths($branchesInstructions, $previousPath) as $branch) {
            foreach ($this->extractPaths($remainderInstructions, $branch) as $newBranchedPath) {
                yield $newBranchedPath;
            }
        }
    }

    private function advanceScout(Scout $scout, string $step): void
    {
        $room = $scout->getRoom();
        switch ($step) {
            case 'N':
                $newRoom = $this->addRoom($room->getX(), $room->getY() + 1);
                break;
            case 'S':
                $newRoom = $this->addRoom($room->getX(), $room->getY() - 1);
                break;
            case 'E':
                $newRoom = $this->addRoom($room->getX() + 1, $room->getY());
                break;
            case 'W':
                $newRoom = $this->addRoom($room->getX() - 1, $room->getY());
                break;
            default:
                throw new \InvalidArgumentException('Unrecognized step: ' . $step);
        }
        
        $scout->setRoom($newRoom);
        $scout->addStepToPath($step);
    }

    private function addRoom(int $x, int $y): Room
    {
        if ($this->map[$y][$x] ?? false) {
            return $this->map[$y][$x];
        }

        $this->map[$y][$x] = $room = new Room($x, $y);

        $room->setNord($this->map[$y + 1][$x] ?? null);
        $room->setSouth($this->map[$y - 1][$x] ?? null);
        $room->setEast($this->map[$y][$x + 1] ?? null);
        $room->setWest($this->map[$y][$x - 1] ?? null);
        
        return $room;
    }

    /**
     * @return bool|int
     */
    private function findClosedParenthesis(string $instructions, int $startFrom)
    {
        $openParenthesisPosition = $closedParenthesis = $startFrom;
        do {
            $closedParenthesis = \strpos($instructions, ')', $closedParenthesis + 1);
            $possibleMatch = substr($instructions, $openParenthesisPosition,
                $closedParenthesis - $openParenthesisPosition);
            $openParenthesisPosition = \strpos($possibleMatch, '(', $openParenthesisPosition);
        } while (false !== $openParenthesisPosition);

        return $closedParenthesis;
    }

    /**
     * @param array $scoutPositions
     * @return array
     */
    private function cloneScouts(array $scoutPositions): array
    {
        return array_map(function (Scout $scout) {
            return clone $scout;
        }, $scoutPositions);
    }
}
