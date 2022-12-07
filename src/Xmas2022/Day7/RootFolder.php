<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day7;

class RootFolder
{
    /** @var array<string, Folder> */
    private array $subfolders = [];
    /** @var File[] */
    private array $files = [];
    private ?int $size = null;

    protected function __construct(public readonly string $name = '/')
    {
    }

    final public static function createFromInput(string $input): RootFolder
    {
        $rootFolder = new RootFolder();
        $currentFolder = $rootFolder;

        foreach (explode('$ ', $input) as $instruction) {
            $command = \Safe\substr($instruction, 0, 2);

            if ('cd' === $command) {
                $currentFolder = $currentFolder->getSubFolder(trim(\Safe\substr($instruction, 3)));
            } elseif ('ls' === $command) {
                $currentFolder->parseLsAsContent($instruction);
            }
        }

        return $rootFolder;
    }

    public function getSubFolder(string $name): RootFolder
    {
        if ($name === $this->name) {
            return $this;
        }

        return $this->subfolders[$name]
            ?? throw new \RuntimeException('Subfolder not found: [' . $name . ']');
    }

    public function getRecursiveSizeOfDirectoriesBelow(int $max): int
    {
        $total = 0;

        if ($this->getSize() < $max) {
            $total += $this->getSize();
        }

        foreach ($this->subfolders as $folder) {
            $total += $folder->getRecursiveSizeOfDirectoriesBelow($max);
        }

        return $total;
    }

    public function getSize(): int
    {
        return $this->size ??= $this->calculateSize();
    }

    private function calculateSize(): int
    {
        $total = 0;
        foreach ($this->files as $file) {
            $total += $file->size;
        }

        foreach ($this->subfolders as $folder) {
            $total += $folder->getSize();
        }

        return $total;
    }

    public function parseLsAsContent(string $ls): void
    {
        $ls = trim($ls);

        foreach (explode(PHP_EOL, $ls) as $line) {
            if ($line === 'ls') {
                continue;
            }

            if (str_starts_with($line, 'dir')) {
                $name = substr($line, 4);
                $this->subfolders[$name] = new Folder($name, $this);

                continue;
            }

            if (1 !== \Safe\preg_match('/^(\d+) (\w+)/', $line, $matches)) {
                throw new \InvalidArgumentException('Parsing failed: ' . $line);
            }

            $this->files[] = new File($matches[2], (int) $matches[1]);
        }
    }
}
