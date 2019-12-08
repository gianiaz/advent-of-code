<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day8;

use Jean85\AdventOfCode\Xmas2019\Day8\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testLayers(): void
    {
        $image = new Image('123456789012', 3, 2);
        $expected = [
            ['1', '2', '3', '4', '5', '6'],
            ['7', '8', '9', '0', '1', '2'],
        ];

        $this->assertSame($expected, $image->getLayers());
    }

    /**
     * @dataProvider imageChecksumProvider
     */
    public function testChecksum(string $data, int $expectedChecksum): void
    {
        $image = new Image($data, 3, 2);

        $this->assertSame($expectedChecksum, $image->getChecksum());
    }

    public function imageChecksumProvider()
    {
        return [
            ['123456789012', 1],
            ['111111111110', 0],
            ['211111111110', 5],
        ];
    }

    public function testFinalImage(): void
    {
        $image = new Image('0222112222120000', 2, 2);

        $this->assertSame('0110', $image->getFinalImage());
    }
}
