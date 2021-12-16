<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class OperatorPacket extends AbstractPacket
{
    private int $typeId;
    /** @var AbstractPacket[] */
    private array $subPackets;

    public function __construct(int $version, int $typeId, array $subPackets)
    {
        parent::__construct($version);
        $this->typeId = $typeId;
        $this->subPackets = $subPackets;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getParsedData(): int
    {
        throw new \RuntimeException('TODO');
    }

    /**
     * @return AbstractPacket[]
     */
    public function getSubPackets(): array
    {
        return $this->subPackets;
    }
}
