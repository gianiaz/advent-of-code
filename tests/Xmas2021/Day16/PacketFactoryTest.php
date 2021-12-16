<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day16;

use Jean85\AdventOfCode\Xmas2021\Day16\LiteralPacket;
use Jean85\AdventOfCode\Xmas2021\Day16\OperatorPacket;
use Jean85\AdventOfCode\Xmas2021\Day16\PacketFactory;
use PHPUnit\Framework\TestCase;

class PacketFactoryTest extends TestCase
{
    public function testLiteralPacketCreation(): void
    {
        $packet = (new PacketFactory())->create($this->createStreamFromBin('110100101111111000101000'));

        $this->assertInstanceOf(LiteralPacket::class, $packet);
        $this->assertSame(6, $packet->getVersion());
        $this->assertSame(4, $packet->getTypeId());
        $this->assertSame(['0111', '1110', '0101'], $packet->getRawData());
        $this->assertSame(2021, $packet->getParsedData());
    }

    public function testOperatorPacketCreation(): void
    {
        $packet = (new PacketFactory())->create($this->createStreamFromBin('00111000000000000110111101000101001010010001001000000000'));

        $this->assertInstanceOf(OperatorPacket::class, $packet);
        $this->assertSame(1, $packet->getVersion());
        $this->assertSame(6, $packet->getTypeId());
        $subPackets = $packet->getSubPackets();
        $this->assertCount(2, $subPackets);
        $this->assertContainsOnlyInstancesOf(LiteralPacket::class, $subPackets);
        $this->assertSame(10, $subPackets[0]->getParsedData());
        $this->assertSame(20, $subPackets[1]->getParsedData());
    }

    public function testOperatorWithHexPacket(): void
    {
        $packet = (new PacketFactory())->create($this->createStreamFromHex('EE00D40C823060'));

        $this->assertInstanceOf(OperatorPacket::class, $packet);
        $this->assertSame(7, $packet->getVersion());
        $this->assertSame(3, $packet->getTypeId());
        $subPackets = $packet->getSubPackets();
        $this->assertCount(3, $subPackets);
        $this->assertContainsOnlyInstancesOf(LiteralPacket::class, $subPackets);
        $this->assertSame(1, $subPackets[0]->getParsedData());
        $this->assertSame(2, $subPackets[1]->getParsedData());
        $this->assertSame(3, $subPackets[2]->getParsedData());
    }

    /**
     * @return resource
     */
    private function createStreamFromBin(string $string)
    {
        $stream = fopen('php://memory', 'r+');
        if (false === $stream) {
            throw new \RuntimeException();
        }

        fwrite($stream, $string);
        rewind($stream);

        return $stream;
    }

    /**
     * @return resource
     */
    private function createStreamFromHex(string $string)
    {
        return $this->createStreamFromBin(hex2bin($string));
    }
}
