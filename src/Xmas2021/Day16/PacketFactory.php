<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class PacketFactory
{
    private const TYPE_LITERAL = 4;

    // operators type length
    private const TOTAL_LENGTH = 0;
    private const SUBPACKET_NUMBER = 1;

    public function create(string $input): AbstractPacket
    {
        $version = bindec(substr($input, 0, 3));
        $typeId = bindec(substr($input, 3, 3));
        $data = substr($input, 6);

        switch ($typeId) {
            case self::TYPE_LITERAL:
                return new LiteralPacket($version, $data);
            default: // operators
                $lengthTypeId = (int)$data[0];

                switch ($lengthTypeId) {
                    case self::TOTAL_LENGTH:
                        $length = bindec(substr($data, 1, 15));
                        $subPacketsRawData = substr($data, 16, $length);
                    case self::SUBPACKET_NUMBER:
                        $subPacketNumber = bindec(substr($data, 1, 11));
                    default:
                        throw new \InvalidArgumentException('Invalid length type: ' . $this->lengthTypeId);
                }

                return new OperatorPacket($version, $typeId, $subPackets);
        }
    }
}
