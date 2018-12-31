<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day20;

class PathNode
{
    /** @var string */
    private $nodeSteps;
    
    /** @var self|null */
    private $next;

    /** @var self[] */
    private $branches;

    /**
     * PathNode constructor.
     */
    public function __construct(string $nodeSteps)
    {
        $this->nodeSteps = $nodeSteps;
        $this->branches = [];
    }

    public function getNodeSteps(): string
    {
        return $this->nodeSteps;
    }

    /**
     * @return PathNode[]
     */
    public function getBranches(): array
    {
        return $this->branches;
    }

    public function addBranch(self $branch): void
    {
        $this->branches[] = $branch;
    }

    public function getNext(): ?PathNode
    {
        return $this->next;
    }

    public function setNext(PathNode $nextNode): void
    {
        $this->next = $nextNode;
    }

    /**
     * @return \Generator|string[]
     */
    public function getPossiblePaths(): \Generator
    {
        if (empty($this->branches)) {
            yield $this->nodeSteps;

            return;
        }

        foreach ($this->branches as $branch) {
            foreach ($branch->getPossiblePaths() as $possibleBranchedPath) {
                if ($this->next) {
                    foreach ($this->next->getPossiblePaths() as $possibleNextPath) {
                        yield $this->nodeSteps . $possibleBranchedPath . $possibleNextPath;
                    }
                } else {
                    yield $this->nodeSteps . $possibleBranchedPath;
                }
            }
        }
    }
}
