<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day12;

class Caves
{
    /** @var array<string, string[]> */
    private array $links = [];

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL, $input) as $instruction) {
            [$start, $end] = explode('-', $instruction);
            $this->links[$start][] = $end;
            $this->links[$end][] = $start;
        }
    }

    /**
     * @return string[]
     */
    public function getAllPaths(array $previousSteps = ['start']): array
    {
        $possiblePaths = [];
        $lastStep = end($previousSteps);

        foreach ($this->links[$lastStep] as $link) {
            if ($link === 'end') {
                $possiblePaths[] = [...$previousSteps, $link];
                continue;
            }

            if ($link === strtolower($link) && in_array($link, $previousSteps, true)) {
                continue;
            }

            foreach ($this->getAllPaths([...$previousSteps, $link]) as $subPath) {
                $possiblePaths[] = $subPath;
            }
        }

        return $possiblePaths;
    }
}
