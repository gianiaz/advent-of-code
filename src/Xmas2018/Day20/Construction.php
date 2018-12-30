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

    /** @var PathNode */
    private $rootNode;

    /** @var string[][] */
    private $map;

    public function __construct(string $instructions)
    {
        $this->instructions = \ltrim($instructions, '^');
        $this->rootNode = new PathNode('');
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

    public function getRootNode(): PathNode
    {
        return $this->rootNode;
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
        return \iterator_to_array($this->getRootNode()->getPossiblePaths());
    }

    public function processPaths(): void
    {
        $this->extractPaths($this->rootNode);
    }

    private function extractPaths(PathNode $currentNode, int $startFrom = 0): void
    {
        $i = $startFrom;
        $currentStep = '';
        while ($char = $this->instructions[$i++] ?? false) {
            switch ($char) {
                case 'N':
                case 'S':
                case 'E':
                case 'W':
                    $currentStep .= $char;
                    break;
                case '|':
                    $currentNode->addBranch(new PathNode($currentStep));
                    $currentStep = '';
                    break;
                case '(':
                    $branchRoot = new PathNode($currentStep);
                    $currentNode->addBranch($branchRoot);
                    $this->extractPaths($branchRoot, $i);

                    return;
                case ')':
                case '$':
                    $currentNode->addBranch(new PathNode($currentStep));

                    return;
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
