<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day11;

class Jungle
{
    /** @var Monkey[] */
    private array $monkeys;

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL . PHP_EOL, $input) as $description) {
            $this->monkeys[] = new Monkey($this, $description);
        }
    }

    public function doRound(): void
    {
        foreach ($this->monkeys as $monkey) {
            $monkey->doTurn();
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
