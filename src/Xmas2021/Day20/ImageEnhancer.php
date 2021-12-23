<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day20;

class ImageEnhancer
{
    private const LIGHT = '#';
    /** @var array<int,bool> */
    private array $algorithm = [];

    public function __construct(string $algorithm)
    {
        if (strlen($algorithm) !== 512) {
            throw new \InvalidArgumentException();
        }

        foreach (str_split($algorithm) as $i => $char) {
            $this->algorithm[$i] = ($char === self::LIGHT);
        }
    }

    public function enhance(Image $oldImage): Image
    {
        if ($this->algorithm[0]) {
            $default = ! $oldImage->getDefault();
        } else {
            $default = $oldImage->getDefault();
        }

        $newImage = new Image($default);

        foreach (range($oldImage->getMinY() - 1, $oldImage->getMaxY() + 1) as $y) {
            foreach (range($oldImage->getMinX() - 1, $oldImage->getMaxX() + 1) as $x) {
                $number = $oldImage->extractValue($x, $y);
                $newImage->setPixel($x, $y, $this->algorithm[$number]);
            }
        }

        return $newImage;
    }
}
