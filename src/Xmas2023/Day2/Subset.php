<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day2;

use Webmozart\Assert\Assert;

class Subset
{
    public int $blue = 0;
    public int $red = 0;
    public int $green = 0;

    public static function parse(string $input): self
    {
        $subset = new self();

        foreach (explode(';', $input) as $subsetString) {
            foreach (explode(',', $subsetString) as $colorString) {
                $singleColorString = explode(' ', trim($colorString));
                Assert::count($singleColorString, 2);
                [$count, $color] = $singleColorString;
                Assert::propertyExists($subset, $color);

                $subset->$color = max((int) $count, $subset->$color);
            }
        }

        return $subset;
    }

    public function isPossible(self $realSubset): bool
    {
        return $realSubset->blue >= $this->blue
            && $realSubset->red >= $this->red
            && $realSubset->green >= $this->green
        ;
    }

    public function getPower(): int
    {
        return $this->red * $this->blue * $this->green;
    }
}
