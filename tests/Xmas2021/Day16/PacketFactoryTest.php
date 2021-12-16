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
        $packet = (new PacketFactory())->create($this->createStreamFromHex('38006F45291200'));

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

    public function testNestedOperatorPackets(): void
    {
        $packet = (new PacketFactory())->create($this->createStreamFromHex('8A004A801A8002F478'));

        $this->assertInstanceOf(OperatorPacket::class, $packet);
        $this->assertSame(4, $packet->getVersion());
        $subPackets = $packet->getSubPackets();
        $this->assertCount(1, $subPackets);

        $nestedOperator = array_pop($subPackets);
        $this->assertInstanceOf(OperatorPacket::class, $nestedOperator);
        $this->assertSame(1, $nestedOperator->getVersion());

        $subPackets2 = $nestedOperator->getSubPackets();
        $this->assertCount(1, $subPackets2);
        $nestedOperator = array_pop($subPackets2);
        $this->assertInstanceOf(OperatorPacket::class, $nestedOperator);
        $this->assertSame(5, $nestedOperator->getVersion());

        $subPackets3 = $nestedOperator->getSubPackets();
        $this->assertCount(1, $subPackets3);
        $nestedLiteral = array_pop($subPackets3);
        $this->assertInstanceOf(LiteralPacket::class, $nestedLiteral);
        $this->assertSame(6, $nestedLiteral->getVersion());
    }

    /**
     * @return resource
     */
    private function createStreamFromHex(string $string)
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
    private function createStreamFromBin(string $string)
    {
        $hexString = '';
        foreach (str_split($string, 4) as $binary) {
            $hexString .= [
                '0000' =>'0',
                '0001' =>'1',
                '0010' =>'2',
                '0011' =>'3',
                '0100' =>'4',
                '0101' =>'5',
                '0110' =>'6',
                '0111' =>'7',
                '1000' =>'8',
                '1001' =>'9',
                '1010' =>'A',
                '1011' =>'B',
                '1100' =>'C',
                '1101' =>'D',
                '1110' =>'E',
                '1111' =>'F',
            ][$binary];
        }

        return $this->createStreamFromHex($hexString);
    }
}
