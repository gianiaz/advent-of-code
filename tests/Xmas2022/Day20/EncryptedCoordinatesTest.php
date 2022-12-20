<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day20;

use Jean85\AdventOfCode\Xmas2022\Day20\EncryptedCoordinates;
use PHPUnit\Framework\TestCase;

class EncryptedCoordinatesTest extends TestCase
{
    public function testSwapsWithTestInput(): void
    {
        $encryptedCoordinates = new EncryptedCoordinates(Day20SolutionTest::TEST_INPUT);

        $this->assertSame([1, 2, -3, 3, -2, 0, 4], $encryptedCoordinates->getStatus());

        $swappedNode = $encryptedCoordinates->swapOneNode();

        $this->assertSame([2, 1, -3, 3, -2, 0, 4], $encryptedCoordinates->getStatus(), 'Mismatch while moving node ' . $swappedNode->value . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $swappedNode = $encryptedCoordinates->swapOneNode();

        $this->assertSame([1, -3, 2, 3, -2, 0, 4], $encryptedCoordinates->getStatus(), 'Mismatch while moving node ' . $swappedNode->value . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $swappedNode = $encryptedCoordinates->swapOneNode();

        $this->assertSame([1, 2, 3, -2, -3, 0, 4], $encryptedCoordinates->getStatus(), 'Mismatch while moving node ' . $swappedNode->value . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $swappedNode = $encryptedCoordinates->swapOneNode();

        $this->assertSame([1, 2, -2, -3, 0, 3, 4], $encryptedCoordinates->getStatus(), 'Mismatch while moving node ' . $swappedNode->value . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $swappedNode = $encryptedCoordinates->swapOneNode();

        $this->assertSame([1, 2, -3, 0, 3, 4, -2], $encryptedCoordinates->getStatus(), 'Mismatch while moving node ' . $swappedNode->value . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $swappedNode = $encryptedCoordinates->swapOneNode();

        $this->assertSame([1, 2, -3, 4, 0, 3, -2], $encryptedCoordinates->getStatus(), 'Mismatch while moving node ' . $swappedNode->value . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->assertSame(4, $encryptedCoordinates->getNode(1000)->value);
        $this->assertSame(-3, $encryptedCoordinates->getNode(2000)->value);
        $this->assertSame(2, $encryptedCoordinates->getNode(3000)->value);
    }
}
