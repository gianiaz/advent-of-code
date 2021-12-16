<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

class OperatorPacket extends AbstractPacket
{
    private const SUM = 0;
    private const PRODUCT = 1;
    private const MIN = 2;
    private const MAX = 3;
    private const GREATER_THAN = 5;
    private const LESS_THAN = 6;
    private const EQUALS = 7;

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

    public function getValue(): int
    {
        switch ($this->typeId) {
            case self::SUM:
                return $this->curry(fn ($a, $b) => $a + $b);
            case self::PRODUCT:
                return $this->curry(fn ($a, $b) => $a * $b, 1);
            case self::MIN:
                return $this->curry('min', PHP_INT_MAX);
            case self::MAX:
                return $this->curry('max');
            case self::GREATER_THAN:
                return $this->curry(fn ($a, $b) => (int) ($a > $b));
            case self::LESS_THAN:
                return $this->curry(fn ($a, $b) => (int) ($a < $b), PHP_INT_MAX);
            case self::EQUALS:
                return (int) ($this->subPackets[0]->getValue() === $this->subPackets[1]->getValue());
        }
    }

    /**
     * @param callable(int, int): int $fn
     */
    private function curry(callable $fn, int $initValue = 0): int
    {
        $value = $initValue;

        foreach ($this->subPackets as $subPacket) {
            $value = $fn($value, $subPacket->getValue());
        }

        return $value;
    }
}
