<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day16;

use Jean85\AdventOfCode\Xmas2021\Day16\Day16Solution;
use Jean85\AdventOfCode\Xmas2021\Day16\OperatorPacket;
use Jean85\AdventOfCode\Xmas2021\Day16\PacketFactory;
use PHPUnit\Framework\TestCase;

class OperatorPacketTest extends TestCase
{
    /**
     * @dataProvider valueDataProvider
     */
    public function testGetValue(string $input, int $expectedValue): void
    {
        $stream = Day16Solution::createStream($input);
        $packet = (new PacketFactory())->create($stream);

        $this->assertInstanceOf(OperatorPacket::class, $packet);
        $this->assertSame($expectedValue, $packet->getValue());
    }

    /**
     * @return array<string, array{string, int}>[]
     */
    public function valueDataProvider(): array
    {
        return [
            'sum' => ['C200B40A82', 1 + 2],
            'product' => ['04005AC33890', 6 * 9],
            'min' => ['880086C3E88112', min(7, 8, 9)],
            'max' => ['CE00C43D881120', max(7, 8, 9)],
            'less than' => ['D8005AC2A8F0', (int) (5 < 15)],
            'more than' => ['F600BC2D8F', (int) (5 > 15)],
            'equal' => ['9C005AC2F8F0', (int) (5 === 15)],
            'equation' => ['9C0141080250320F1802104A08', (int) ((1 + 3) === (2 * 2))],
        ];
    }
}
