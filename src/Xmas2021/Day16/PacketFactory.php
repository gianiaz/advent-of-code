<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class PacketFactory
{
    private const TYPE_LITERAL = 4;

    // operators type length
    private const TOTAL_LENGTH = 0;
    private const SUBPACKET_NUMBER = 1;

    /**
     * @param resource $input
     */
    public function create($input): AbstractPacket
    {
        $input = $this->reparseToBinary($input);

        return $this->createFromBinary($input);
    }

    /**
     * @param resource $input
     */
    private function createFromBinary($input): AbstractPacket
    {
        $version = bindec(\Safe\fread($input, 3));
        $typeId = bindec(\Safe\fread($input, 3));

        if (0 === $version && 0 === $typeId) {
            throw new \RuntimeException('End of stream?');
        }

        switch ($typeId) {
            case self::TYPE_LITERAL:
                return new LiteralPacket($version, $input);
            default: // operators
                return new OperatorPacket($version, $typeId, $this->parseSubpackets($input));
        }
    }

    /**
     * @param resource $input
     *
     * @return AbstractPacket[]
     */
    private function parseSubpackets($input): array
    {
        $lengthTypeId = (int) \Safe\fread($input, 1);

        switch ($lengthTypeId) {
            case self::TOTAL_LENGTH:
                $length = bindec(\Safe\fread($input, 15));
                $subStream = $this->getSubstream($input, $length);
                $subPackets = [];
                try {
                    while ($subPacket = $this->createFromBinary($subStream)) {
                        $subPackets[] = $subPacket;
                    }
                } catch (\RuntimeException $e) {
                }

                return $subPackets;
            case self::SUBPACKET_NUMBER:
                $subPacketCount = bindec(\Safe\fread($input, 11));
                while ($subPacketCount--) {
                    $subPackets[] = $this->createFromBinary($input);
                }

                return $subPackets;
            default:
                throw new \InvalidArgumentException('Invalid length type: ' . $lengthTypeId);
        }
    }

    /**
     * @param resource $input
     *
     * @return resource
     */
    private function getSubstream($input, int $length)
    {
        $substream = \Safe\fopen('php://memory', 'r+');
        fwrite($substream, \Safe\fread($input, $length));
        rewind($substream);

        return $substream;
    }

    /**
     * @param resource $hexInput
     *
     * @return resource
     */
    private function reparseToBinary($hexInput)
    {
        $binaryInput = \Safe\fopen('php://memory', 'r+');
        foreach (str_split(stream_get_contents($hexInput)) as $char) {
            $translate = [
                '0' => '0000',
                '1' => '0001',
                '2' => '0010',
                '3' => '0011',
                '4' => '0100',
                '5' => '0101',
                '6' => '0110',
                '7' => '0111',
                '8' => '1000',
                '9' => '1001',
                'A' => '1010',
                'B' => '1011',
                'C' => '1100',
                'D' => '1101',
                'E' => '1110',
                'F' => '1111',
            ][$char];
            \Safe\fwrite($binaryInput, $translate, 4);
        }

        \Safe\fclose($hexInput);
        rewind($binaryInput);

        return $binaryInput;
    }
}
