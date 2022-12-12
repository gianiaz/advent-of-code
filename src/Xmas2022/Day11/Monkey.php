<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day11;

class Monkey
{
    /** @var int[] */
    private array $items = [];

    private Operation $operation;

    public readonly int $testDividend;
    private int $ifTrue;
    private int $ifFalse;

    private int $inspectCounter = 0;

    public function __construct(private readonly Jungle $jungle, string $input, private readonly bool $getsBored)
    {
        \Safe\preg_match('/Starting items: ([\d, ]+)/', $input, $matches);
        foreach (explode(', ', $matches[1]) as $item) {
            $this->items[] = (int) $item;
        }

        $this->operation = new Operation($input);

        \Safe\preg_match('/Test: divisible by (\d+)/', $input, $matches);
        $this->testDividend = (int) $matches[1];

        \Safe\preg_match('/If true: throw to monkey (\d+)/', $input, $matches);
        $this->ifTrue = (int) $matches[1];

        \Safe\preg_match('/If false: throw to monkey (\d+)/', $input, $matches);
        $this->ifFalse = (int) $matches[1];
    }

    public function doTurn(): void
    {
        while ($item = array_shift($this->items)) {
            $new = $this->operation->apply($item);
            if ($this->getsBored) {
                $new = (int) floor($new / 3.0);
            }

            $new %= $this->jungle->commonMultiple;

            $recipient = $this->getRecipient($new);
            $this->jungle->getMonkey($recipient)->items[] = $new;
            ++$this->inspectCounter;
        }
    }

    private function getRecipient(int $new): int
    {
        return (0 === ($new % $this->testDividend))
            ? $this->ifTrue
            : $this->ifFalse;
    }

    /**
     * @return int[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getInspectCounter(): int
    {
        return $this->inspectCounter;
    }
}
