<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day7;

class Hand
{
    /** @var array<value-of<Card>, int> */
    public readonly array $mappedCards;

    public function __construct(
        /** @var Card[] */
        public readonly array $cards,
        public readonly int $bidding,
        private readonly string $originalHand,
        private readonly bool $withJokers,
    ) {
        $map = [];
        $sortedCards = $this->cards;
        sort($sortedCards);
        foreach ($sortedCards as $card) {
            $map[$card->value] ??= 0;
            ++$map[$card->value];
        }
        asort($map);
        $map = array_reverse($map);

        if ($this->withJokers) {
            $map = $this->remapJokers($map);
        }

        $this->mappedCards = $map;
    }

    public static function parse(string $input, bool $withJokers = false): self
    {
        $cards = [];

        [$hand, $bidding] = explode(' ', $input);

        foreach (str_split(trim($hand)) as $char) {
            $cards[] = Card::from($char);
        }

        return new self($cards, (int) $bidding, $hand, $withJokers);
    }

    public function getType(): HandType
    {
        return match (array_values($this->mappedCards)) {
            [5] => HandType::FiveOfAKind,
            [4, 1] => HandType::FourOfAKind,
            [3, 2] => HandType::FullHouse,
            [3, 1, 1] => HandType::ThreeOfAKind,
            [2, 2, 1] => HandType::TwoPair,
            [2, 1, 1, 1] => HandType::OnePair,
            [1, 1, 1, 1, 1] => HandType::HighCard,
            default => throw new \InvalidArgumentException('Invalid combination for hand ' . $this->originalHand . PHP_EOL . print_r(array_values($this->mappedCards), true)),
        };
    }

    public static function rank(array &$hands): void
    {
        usort($hands, [__CLASS__, 'compare']);
    }

    public static function compare(self $a, self $b): int
    {
        if ($a->getType() !== $b->getType()) {
            return $a->getType()->value <=> $b->getType()->value;
        }

        foreach (range(0, 4) as $rank) {
            if ($a->cards[$rank] !== $b->cards[$rank]) {
                return $a->cards[$rank]->getRank($a->withJokers) <=> $b->cards[$rank]->getRank($b->withJokers);
            }
        }

        throw new \LogicException('There should be no draws');
    }

    public function __toString(): string
    {
        return $this->originalHand;
    }

    /**
     * @param array<value-of<Card>, int> $map
     *
     * @return array<value-of<Card>, int>
     */
    private function remapJokers(array $map): array
    {
        if (! isset($map[Card::J->value]) || count($map) === 1) {
            return $map;
        }

        $jokers = $map[Card::J->value];
        unset($map[Card::J->value]);

        $map[array_keys($map)[0]] += $jokers;

        return $map;
    }
}
