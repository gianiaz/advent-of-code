<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day8;

class Image
{
    /** @var string */
    private $data;

    /** @var void string[][] */
    private $layers;

    /** @var int */
    private $width;

    /** @var int */
    private $height;

    public function __construct(string $data, int $width, int $height)
    {
        $this->data = $data;
        $this->width = $width;
        $this->height = $height;
        $this->layers = $this->buildLayers();
    }

    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return string[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    public function getChecksum(): int
    {
        $layer = $this->getLayerWithLessZeros();

        return $this->countChars($layer, '1') * $this->countChars($layer, '2');
    }

    /**
     * @return string[]
     */
    private function getLayerWithLessZeros(): array
    {
        $count = PHP_INT_MAX;
        foreach ($this->layers as $layer) {
            $zeroCount = $this->countChars($layer, '0');

            if ($zeroCount < $count) {
                $count = $zeroCount;
                $bestLayer = $layer;
            }
        }

        return $bestLayer;
    }

    private function buildLayers(): array
    {
        foreach (str_split($this->data, $this->height * $this->width) as $layer) {
            $layers[] = str_split($layer, 1);
        }

        return $layers;
    }

    /**
     * @param string[] $layer
     */
    private function countChars(array $layer, string $charToFind): int
    {
        $charCount = 0;
        foreach ($layer as $char) {
            if ($char === $charToFind) {
                ++$charCount;
            }
        }

        return $charCount;
    }
}
