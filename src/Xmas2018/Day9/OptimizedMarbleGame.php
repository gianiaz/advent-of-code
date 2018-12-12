<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9;

class OptimizedMarbleGame
{
    /** @var int[] */
    private $players;

    /** @var int */
    private $turn = 0;

    /** @var int */
    private $lastMarble;

    /** @var bool */
    private $debug = false;

    /** @var string[] */
    private $debugTrace = [];

    public function __construct(int $players, int $lastMarble)
    {
        foreach (range(1, $players) as $i) {
            $this->players[$i] = 0;
        }

        $this->lastMarble = $lastMarble;
    }

    public function enableDebug(): void
    {
        $this->debug = true;
    }

    public function getDebugTrace(): array
    {
        return $this->debugTrace;
    }

    public function play(): int
    {
        $currentPlayer = 0;
        $marbles = [];
        $currentMarble = 0;

        $this->addDebugTrace($currentPlayer, $marbles, $currentMarble);

        do {
            $currentPlayer = ($currentPlayer + 1) % \count($this->players);
            if ($currentPlayer === 0) {
                $currentPlayer = \count($this->players);
            }

            ++$this->turn;

            if ($this->turn % 23 === 0) {
                $this->players[$currentPlayer] += $this->turn;

                $marbleToExtract = \array_slice($marbles, -7, 1, true);
                $this->players[$currentPlayer] += \array_pop($marbleToExtract);

                $newCurrentMarble = \array_slice($marbles, -6, 1, true);

                $marbles = \array_merge(
                    \array_slice($marbles, -5, null, true),
                    [$currentMarble],
                    \array_slice($marbles, 0, -7, true)
                );

                $currentMarble = \array_pop($newCurrentMarble);
            } else {
                $marbles[] = $currentMarble;

                $first = \array_key_first($marbles);
                $marbles[] = $marbles[$first];
                unset($marbles[$first]);

                $currentMarble = $this->turn;
            }

            if ($this->turn % 10000 === 0) {
                echo date('H:i:s') . $this->turn . PHP_EOL;
            }

            $this->addDebugTrace($currentPlayer, $marbles, $currentMarble);
        } while ($this->turn < $this->lastMarble);

        return max($this->players);
    }

    private function addDebugTrace(int $currentPlayer, array $marbles, int $currentMarble)
    {
        if (! $this->debug) {
            return;
        }

        $debugTrace = sprintf('[%d] ', $currentPlayer);

        foreach ($marbles as $marble) {
            $debugTrace .= ' ';
            $debugTrace .= $marble;
        }

        $debugTrace .= ' ';
        $debugTrace .= $currentMarble . '<';

        $debugTrace = preg_replace('/\s+/', ' ', $debugTrace);

        $this->debugTrace[] = $debugTrace;
    }
}
