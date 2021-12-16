<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class OperatorPacket extends AbstractPacket
{

    private int $typeId;
    private int $lengthTypeId;

    public function __construct(int $version, int $typeId, string $data)
    {
        parent::__construct($version);
        $this->typeId = $typeId;
        $this->lengthTypeId = (int)$data[0];

        switch ($this->lengthTypeId) {
            case self::TOTAL_LENGTH:
                $length = bindec(substr($data, 1, 15));
                $subPackets = substr($data, 16, $length);
            case self::SUBPACKET_NUMBER:
                $subPacketNumber = bindec(substr($data, 1, 11));
            default:
                throw new \InvalidArgumentException('Invalid length type: ' . $this->lengthTypeId); 
        }
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getLengthTypeId(): int
    {
        return $this->lengthTypeId;
    }

    public function getParsedData(): int
    {
        throw new \RuntimeException('TODO');
    }
}
