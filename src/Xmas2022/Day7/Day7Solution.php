<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day7;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day7Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $rootFolder = RootFolder::createFromInput($input);

        return (string) $rootFolder->getRecursiveSizeOfDirectoriesBelow(100000);
    }

    public function solveSecondPart(string $input = null): string
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $rootFolder = RootFolder::createFromInput($input);
        $freeSpace = 70000000 - $rootFolder->getSize();
        $neededSpace = 30000000 - $freeSpace;

        $smallest = $rootFolder;
        foreach ($rootFolder->getRecursiveIterator() as $folder) {
            if ($folder->getSize() < $neededSpace) {
                continue;
            }

            if ($folder->getSize() < $smallest->getSize()) {
                $smallest = $folder;
            }
        }

        return (string) $smallest->getSize();
    }
}
