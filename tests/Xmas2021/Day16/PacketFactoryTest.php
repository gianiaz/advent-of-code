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
        $packet = (new PacketFactory())->create('110100101111111000101000');

        $this->assertInstanceOf(LiteralPacket::class, $packet);
        $this->assertSame(6, $packet->getVersion());
        $this->assertSame(4, $packet->getTypeId());
        $this->assertSame(['0111', '1110', '0101'], $packet->getRawData());
        $this->assertSame(2021, $packet->getParsedData());
    }

    public function testOperatorPacketCreation(): void
    {
        $packet = (new PacketFactory())->create('00111000000000000110111101000101001010010001001000000000');

        $this->assertInstanceOf(OperatorPacket::class, $packet);
        $this->assertSame(1, $packet->getVersion());
        $this->assertSame(6, $packet->getTypeId());
        $this->assertSame(['11010001010', '0101001000100100'], $packet->getRawData());
        $this->markTestIncomplete();
        $this->assertSame(2021, $packet->getParsedData());
    }
}
