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
                    while ($subPacket = $this->create($subStream)) {
                        $subPackets[] = $subPacket;
                    }
                } catch (\RuntimeException $e) {
                }

                return $subPackets;
            case self::SUBPACKET_NUMBER:
                $subPacketNumber = bindec(\Safe\fread($input, 11));
                break;
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
}
