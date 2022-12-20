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

    public function testAssumptionAboutModule(): void
    {
        $encryptedCoordinates = new EncryptedCoordinates(Day20SolutionTest::TEST_INPUT);
        $initialStatus = [0, 4, 1, 2, -3, 3, -2];

        $this->assertSame($initialStatus, $encryptedCoordinates->getStatusFromZero());

        $node = $encryptedCoordinates->firstNode;
        $node->remainingSwaps = count($initialStatus) - 1;

        $this->assertSame($node, $encryptedCoordinates->swapOneNode());
        $this->assertSame($initialStatus, $encryptedCoordinates->getStatusFromZero());
    }

    public function testSecondPartSwapsWithTestInput(): void
    {
        $decryptionKey = 811589153;
        $encryptedCoordinates = new EncryptedCoordinates(Day20SolutionTest::TEST_INPUT, $decryptionKey);
        $round = 0;

        $this->assertSame([811589153, 1623178306, -2434767459, 2434767459, -1623178306, 0, 3246356612], $encryptedCoordinates->getStatus());
        $this->assertSame([0, 3246356612, 811589153, 1623178306, -2434767459, 2434767459, -1623178306], $encryptedCoordinates->getStatusFromZero());

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, -2434767459, 3246356612, -1623178306, 2434767459, 1623178306, 811589153], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 2434767459, 1623178306, 3246356612, -2434767459, -1623178306, 811589153], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 811589153, 2434767459, 3246356612, 1623178306, -1623178306, -2434767459], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 1623178306, -2434767459, 811589153, 2434767459, 3246356612, -1623178306], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 811589153, -1623178306, 1623178306, -2434767459, 3246356612, 2434767459], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 811589153, -1623178306, 3246356612, -2434767459, 1623178306, 2434767459], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, -2434767459, 2434767459, 1623178306, -1623178306, 811589153, 3246356612], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 1623178306, 3246356612, 811589153, -2434767459, 2434767459, -1623178306], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, 811589153, 1623178306, -2434767459, 3246356612, 2434767459, -1623178306], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->doOneSwapRound($encryptedCoordinates);

        $this->assertSame([0, -2434767459, 1623178306, 3246356612, -1623178306, 2434767459, 811589153], $encryptedCoordinates->getStatus(), 'Mismatch while mixing round ' . ++$round . PHP_EOL . json_encode($encryptedCoordinates->getStatus()));

        $this->assertSame(811589153, $encryptedCoordinates->getNode(1000)->value * $decryptionKey);
        $this->assertSame(2434767459, $encryptedCoordinates->getNode(2000)->value * $decryptionKey);
        $this->assertSame(-1623178306, $encryptedCoordinates->getNode(3000)->value * $decryptionKey);
    }

    private function doOneSwapRound(EncryptedCoordinates $encryptedCoordinates): void
    {
        $encryptedCoordinates->resetSwapCounts();

        do {
        } while ($encryptedCoordinates->swapOneNode());
    }
}
