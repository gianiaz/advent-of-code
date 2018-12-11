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
        $leftMarbles = [];
        $currentMarble = 0;
        $rightMarbles = [];

        $this->addDebugTrace($currentPlayer, $leftMarbles, $currentMarble, $rightMarbles);

        do {
            $currentPlayer = ($currentPlayer + 1) % \count($this->players);
            if ($currentPlayer === 0) {
                $currentPlayer = \count($this->players);
            }

            ++$this->turn;

            if ($this->turn % 23 === 0) {
                $this->players[$currentPlayer] += $this->turn + $this->shift7ToTheLeftAndExtract($leftMarbles, $currentMarble, $rightMarbles);
                $currentMarble = array_shift($rightMarbles);
            } else {
                $this->shiftToTheRight($leftMarbles, $currentMarble, $rightMarbles);
                $currentMarble = $this->turn;
            }

            $this->addDebugTrace($currentPlayer, $leftMarbles, $currentMarble, $rightMarbles);
        } while ($this->turn < $this->lastMarble);

        return max($this->players);
    }

    private function shiftToTheRight(array &$leftMarbles, int $currentMarble, array &$rightMarbles): void
    {
        $leftMarbles[] = $currentMarble;

        if (0 === \count($rightMarbles)) {
            $leftMarbles[] = array_shift($leftMarbles);
        } else {
            $leftMarbles[] = array_shift($rightMarbles);
        }
    }

    private function shift7ToTheLeftAndExtract(array &$leftMarbles, int $currentMarble, array &$rightMarbles): int
    {
        array_unshift($rightMarbles, $currentMarble);

        for ($i = 0; $i < 6; ++$i) {
            if (0 === \count($leftMarbles)) {
                array_unshift($rightMarbles, array_pop($rightMarbles));
            } else {
                array_unshift($rightMarbles, array_pop($leftMarbles));
            }
        }

        if (0 === \count($leftMarbles)) {
            return array_pop($rightMarbles);
        } else {
            return array_pop($leftMarbles);
        }
    }

    private function addDebugTrace(int $currentPlayer, array $leftMarbles, int $currentMarble, array $rightMarbles)
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
