<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9;

use Ds\Deque;

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
        $leftMarbles = new Deque();
        $currentMarble = 0;
        $rightMarbles = new Deque();

        $this->addDebugTrace($currentPlayer, $leftMarbles, $currentMarble, $rightMarbles);

        do {
            $currentPlayer = ($currentPlayer + 1) % \count($this->players);
            if ($currentPlayer === 0) {
                $currentPlayer = \count($this->players);
            }

            ++$this->turn;

            if ($this->turn % 23 === 0) {
                $this->players[$currentPlayer] += $this->turn + $this->shift7ToTheLeftAndExtract($leftMarbles, $currentMarble, $rightMarbles);
                $currentMarble = $rightMarbles->shift();
            } else {
                $this->shiftToTheRight($leftMarbles, $currentMarble, $rightMarbles);
                $currentMarble = $this->turn;
            }

            $this->addDebugTrace($currentPlayer, $leftMarbles, $currentMarble, $rightMarbles);
        } while ($this->turn < $this->lastMarble);

        return max($this->players);
    }

    private function shiftToTheRight(Deque $leftMarbles, int $currentMarble, Deque $rightMarbles): void
    {
        $leftMarbles->push($currentMarble);

        if (0 === \count($rightMarbles)) {
            $leftMarbles->push($leftMarbles->shift());
        } else {
            $leftMarbles->push($rightMarbles->shift());
        }
    }

    private function shift7ToTheLeftAndExtract(Deque $leftMarbles, int $currentMarble, Deque $rightMarbles): int
    {
        $rightMarbles->unshift($currentMarble);

        for ($i = 0; $i < 6; ++$i) {
            if (0 === \count($leftMarbles)) {
                $rightMarbles->unshift($rightMarbles->pop());
            } else {
                $rightMarbles->unshift($leftMarbles->pop());
            }
        }

        if (0 === \count($leftMarbles)) {
            return $rightMarbles->pop();
        } else {
            return $leftMarbles->pop();
        }
    }

    private function addDebugTrace(int $currentPlayer, Deque $leftMarbles, int $currentMarble, Deque $rightMarbles)
    {
        $debugTrace = sprintf('[%d] ', $currentPlayer);

        foreach ($leftMarbles as $marble) {
            $debugTrace .= ' ';
            $debugTrace .= $marble;
        }

        $debugTrace .= ' ';
        $debugTrace .= $currentMarble . '<';

        foreach ($rightMarbles as $marble) {
            $debugTrace .= ' ';
            $debugTrace .= $marble;
        }

        $debugTrace = preg_replace('/\s+/', ' ', $debugTrace);

        $this->debugTrace[] = $debugTrace;
    }
}
