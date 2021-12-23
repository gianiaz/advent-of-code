<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day20;

use Jean85\AdventOfCode\Xmas2021\Day20\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testToString(): void
    {
        $image = Image::createFromString($this->getTestImage());

        $this->assertSame($this->getTestImage(), $image->__toString());
    }

    public function testExtractValue(): void
    {
        $image = Image::createFromString($this->getTestImage());

        $this->assertSame(34, $image->extractValue(2, 2));
    }

    private function getTestImage(): string
    {
        return '#..#.
#....
##..#
..#..
..###';
    }
}
