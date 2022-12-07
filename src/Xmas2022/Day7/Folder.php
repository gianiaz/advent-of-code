<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day7;

class Folder extends RootFolder
{
    public function __construct(
        string $name,
        private readonly RootFolder $parentFolder,
    ) {
        parent::__construct($name);
    }

    public function getSubFolder(string $name): RootFolder
    {
        return match ($name) {
            '/' => $this->parentFolder->getSubFolder($name),
            '..' => $this->parentFolder,
            default => parent::getSubFolder($name),
        };
    }
}
