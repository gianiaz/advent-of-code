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

    /** @var array */
    private $instructions;

    /** @var string[] */
    private $possiblePaths;

    /** @var string[][] */
    private $map;

    /**
     * Construction constructor.
     */
    public function __construct(array $instructions)
    {
        $this->instructions = $instructions;
        $this->possiblePaths = [];
        $this->map[0][0] = self::CENTER;
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
            foreach (range($minX - 1, $maxX + 1) as $x) {
                $textualMap .= $this->map[$y][$x] ?? self::WALL;
            }
            $textualMap .= PHP_EOL;
        }

        return $textualMap;
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
        foreach ($this->extractPaths($this->instructions) as $extractedPath) {
            $this->possiblePaths[] = $extractedPath;
        }

        foreach ($this->possiblePaths as $path) {
            $this->followPath($path);
        }
    }

    /**
     * @return \Generator|string[]
     */
    private function extractPaths(array $instructions, string $previousSteps = ''): \Generator
    {
        $path = $previousSteps;

        foreach ($instructions as $instruction) {
            if (\is_string($instruction)) {
                yield $path . $instruction;
                continue;
            }
        }
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
