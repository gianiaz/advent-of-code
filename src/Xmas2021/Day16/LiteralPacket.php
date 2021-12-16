<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class LiteralPacket extends AbstractPacket
{
    /** @var string[] */
    protected array $rawData = [];

    /**
     * @param resource $data
     */
    public function __construct(int $version, $data)
    {
        parent::__construct($version);

        $isNotLast = true;
        while ($isNotLast) {
            $binary = fread($data, 5);
            if (strlen($binary) !== 5) {
                throw new \RuntimeException('Truncated data???');
            }

            $this->rawData[] = substr($binary, 1);

            $isNotLast = $binary[0] === '1';
        }
    }

    public function getTypeId(): int
    {
        return 4;
    }

    public function getValue(): int
    {
        return bindec(implode($this->rawData));
    }

    /**
     * @return string[]
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }
}
