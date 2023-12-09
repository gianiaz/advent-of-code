<?php

declare(strict_types=1);

namespace Tests\Xmas2023\Day7;

use Jean85\AdventOfCode\Xmas2023\Day7\Hand;
use Jean85\AdventOfCode\Xmas2023\Day7\HandType;
use PHPUnit\Framework\TestCase;

class HandTest extends TestCase
{
    public function testCompare(): void
    {
        $a = Hand::parse('33332 1');
        $b = Hand::parse('2AAAA 1');

        $this->assertSame(HandType::FourOfAKind, $a->getType());
        $this->assertSame(HandType::FourOfAKind, $b->getType());
        $this->assertSame(1, Hand::compare($a, $b));
        $this->assertSame(-1, Hand::compare($b, $a));
    }

    public function testRank(): void
    {
        $a = Hand::parse('33332 1');
        $b = Hand::parse('2AAAA 1');

        $this->assertRankingEquals([$b, $a], [$a, $b]);
    }

    public function testRankRegression(): void
    {
        $a = Hand::parse('KK677 1');
        $b = Hand::parse('KTJJT 1');

        $this->assertRankingEquals([$b, $a], [$a, $b]);
    }

    public function testRankWithFullExample(): void
    {
        $h32T3K = Hand::parse('32T3K 1');
        $hT55J5 = Hand::parse('T55J5 1');
        $hKK677 = Hand::parse('KK677 1');
        $hKTJJT = Hand::parse('KTJJT 1');
        $hQQQJA = Hand::parse('QQQJA 1');

        $hands = [
            $h32T3K,
            $hT55J5,
            $hKK677,
            $hKTJJT,
            $hQQQJA,
        ];

        $expectedRanking = [
            $h32T3K,
            $hKTJJT,
            $hKK677,
            $hT55J5,
            $hQQQJA,
        ];
        $this->assertRankingEquals($expectedRanking, $hands);
    }

    private function assertRankingEquals(array $expectedRanking, array $hands): void
    {
        Hand::rank($hands);

        $this->assertEquals(array_map([$this, 'handToString'], $expectedRanking), array_map([$this, 'handToString'], $hands));
    }

    private function handToString(Hand $hand): string
    {
        return $hand->__toString();
    }
}
