<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day20;

use Jean85\AdventOfCode\Xmas2021\Day20\Image;
use Jean85\AdventOfCode\Xmas2021\Day20\ImageEnhancer;
use PHPUnit\Framework\TestCase;

class ImageEnhancerTest extends TestCase
{
    public function test(): void
    {
        $imageEnhancer = new ImageEnhancer($this->getTestAlgorithm());
        $image = Image::createFromString($this->getTestImage());

        $this->assertFalse($image->getDefault());
        $this->assertSame(10, $image->countLights());

        $newImage = $imageEnhancer->enhance($image);

        $this->assertFalse($newImage->getDefault());
        $this->assertSame(24, $newImage->countLights());

        $newImage = $imageEnhancer->enhance($newImage);

        $this->assertFalse($newImage->getDefault());
        $this->assertSame(35, $newImage->countLights());
    }

    private function getTestAlgorithm(): string
    {
        return '..#.#..#####.#.#.#.###.##.....###.##.#..###.####..#####..#....#..#..##..###..######.###...####..#..#####..##..#.#####...##.#.#..#.##..#.#......#.###.######.###.####...#.##.##..#..#..#####.....#.#....###..#.##......#.....#..#..#..##..#...##.######.####.####.#.#...#.......#..#.#.#...####.##.#......#..#...##.#.##..#...##.#.##..###.#......#.#.......#.#.#.####.###.##...#.....####.#..#..#.##.#....##..#.####....##...##..#...#......#.#.......#.......##..####..#...#.#.#...##..#.#..###..#####........#..####......#..#';
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
