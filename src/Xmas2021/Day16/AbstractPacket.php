<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

abstract class AbstractPacket
{
    private int $version;
    /** @var string[] */
    protected array $rawData = [];

    public function __construct(int $version)
    {
        $this->version = $version;
    }

    /**
     * @return string[]
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }

    abstract public function getTypeId(): int;

    public function getVersion(): int
    {
        return $this->version;
    }
}
