<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day13;

class Receiver
{
    /**
     * @var array{
     *     list<int|list<int>>,
     *     list<int|list<int>>
     * }[]
     */
    private array $couples;

    public static string $debug;

    public function __construct(string $input)
    {
        foreach (explode(PHP_EOL . PHP_EOL, $input) as $couples) {
            $newCouple = [];

            foreach (explode(PHP_EOL, $couples) as $row) {
                $newCouple[] = \Safe\json_decode($row);
            }

            $this->couples[] = $newCouple;
        }
    }

    /**
     * @return int[]
     */
    public function getIndicesOfSortedCouples(): array
    {
        $result = [];
        self::$debug = '';

        foreach ($this->couples as $index => $couple) {
            self::$debug .= '== Pair ' . ($index + 1) . ' ==' . PHP_EOL;
            if (0 >= $this->getSortOrder($couple[0], $couple[1])) {
                $result[] = $index + 1;
            }
        }

        return $result;
    }

    /**
     * @return 1|0|-1
     */
    private function getSortOrder(array|int $a, array|int $b): int
    {
        self::$debug .= sprintf('- Compare %s vs %s' . PHP_EOL, json_encode($a), json_encode($b));
        if (is_int($a) && is_int($b)) {
            return $a <=> $b;
        }

        if (is_int($a) && is_array($b)) {
            $a = [$a];
        }

        if (is_array($a) && is_int($b)) {
            $b = [$b];
        }

        do {
            $firstA = array_shift($a);
            $firstB = array_shift($b);

            if ($firstA === null || $firstB === null) {
                // end of list
                if ($firstA === $firstB) {
                    return 0;
                }

                return $firstA === null
                    ? -1
                    : 1;
            }
        } while (0 === $result = $this->getSortOrder($firstA, $firstB));

        return $result;
    }

    public function getDecoderKey(): int
    {
        $decoderKey = 1;

        foreach ($this->getSortedPackets() as $i => $packet) {
            if ($packet === [[2]] || $packet === [[6]]) {
                $decoderKey *= $i + 1;
            }
        }

        return $decoderKey;
    }

    private function getSortedPackets(): array
    {
        $packets = [];

        foreach ($this->couples as $couple) {
            $packets[] = $couple[0];
            $packets[] = $couple[1];
        }

        usort($packets, $this->getSortOrder(...));

        return $packets;
    }
}
