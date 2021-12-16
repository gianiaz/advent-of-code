<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class LiteralPacket extends AbstractPacket
{
    public function __construct(int $version, string $data)
    {
        parent::__construct($version);

        $offset = 0;
        $isNotLast = true;
        while ($isNotLast) {
            $binary = substr($data, $offset, 5);
            if (strlen($binary) !== 5) {
                throw new \RuntimeException('Truncated data???');
            }

            $this->rawData[] = substr($binary, 1);

            $isNotLast = $binary[0] === '1';
            $offset += 5;
        }
    }

    public function getTypeId(): int
    {
        return 4;
    }

    public function getParsedData(): int
    {
        return bindec(implode($this->rawData));
    }
}
