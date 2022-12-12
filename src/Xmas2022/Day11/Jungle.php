<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day11;

class Jungle
{
    /** @var Monkey[] */
    private array $monkeys;
    public readonly int $commonMultiple;

    public function __construct(string $input)
    {
        $commonMultiple = 1;
        foreach (explode(PHP_EOL . PHP_EOL, $input) as $description) {
            $monkey = new Monkey($this, $description);
            $commonMultiple *= $monkey->testDividend;
            $this->monkeys[] = $monkey;
        }

        $this->commonMultiple = $commonMultiple;
    }

    public function doRound(bool $getsBored): void
    {
        foreach ($this->monkeys as $monkey) {
            $monkey->doTurn($getsBored);
        }
    }

    public function getMonkey(int $number): Monkey
    {
        return $this->monkeys[$number]
            ?? throw new \InvalidArgumentException('Monkey not found: ' . $number);
    }

    public function getMonkeyBusiness(): int
    {
        $counters = [];

        foreach ($this->monkeys as $monkey) {
            $counters[] = $monkey->getInspectCounter();
        }

        sort($counters);

        return array_pop($counters)
            * array_pop($counters);
    }
}
