<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day8;

class LicenseNode
{
    /** @var self[] */
    private $childNodes = [];
    /** @var int[] */
    private $metadata = [];

    /**
     * @return self[]
     */
    public function getChildNodes(): array
    {
        return $this->childNodes;
    }

    public function addChildNode(self $node): void
    {
        $this->childNodes[] = $node;
    }

    /**
     * @return int[]
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function addMetadata(int $metadata): void
    {
        $this->metadata[] = $metadata;
    }

    public function sumMetadata(): int
    {
        $sum = 0;

        foreach ($this->metadata as $metadatum) {
            $sum += $metadatum;
        }

        foreach ($this->childNodes as $childNode) {
            $sum += $childNode->sumMetadata();
        }

        return $sum;
    }
}
