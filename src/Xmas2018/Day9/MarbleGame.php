<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9;

class MarbleGame
{
    /** @var int[] */
    private $players;

    /** @var int[] */
    private $marbles = [0];

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

    public function play(): int
    {
        $currentMarble = 0;
        $currentPlayer = 0;

        $this->addDebugTrace($currentMarble, $currentPlayer);

        ++$currentMarble;
        ++$currentPlayer;
        ++$this->turn;
        $this->marbles[] = 1;

        $this->addDebugTrace($currentMarble, $currentPlayer);
        do {
            $currentPlayer = ($currentPlayer + 1) % \count($this->players);
            if ($currentPlayer === 0) {
                $currentPlayer = \count($this->players);
            }

            ++$this->turn;

            if ($this->turn % 23 === 0) {
                $marbleToBeRemoved = (\count($this->marbles) + $currentMarble - 7) % \count($this->marbles);
                $this->players[$currentPlayer] += $this->turn + $this->marbles[$marbleToBeRemoved];
                array_splice($this->marbles, $marbleToBeRemoved, 1);
                $currentMarble = $marbleToBeRemoved;
            } else {
                $currentMarble = $this->addMarble($this->turn, $currentMarble);
            }

            $this->addDebugTrace($currentMarble, $currentPlayer);
        } while ($this->turn < $this->lastMarble);

        return max($this->players);
    }

    private function addDebugTrace(int $currentMarble, int $currentPlayer): void
    {
        if (! $this->debug) {
            return;
        }

        $debugTrace = sprintf('[%d]  ', $currentPlayer);
        $i = 0;
        foreach ($this->marbles as $marble) {
            if ($i > 0 && $marble < 10) {
                $debugTrace .= ' ';
            }

            $debugTrace .= $marble;

            if ($i === $currentMarble) {
                $debugTrace .= '<';
            } else {
                $debugTrace .= ' ';
            }

            ++$i;
        }

        $this->debugTrace[] = $debugTrace;
    }

    public function enableDebug(): void
    {
        $this->debug = true;
    }

    public function getDebugTrace(): array
    {
        return $this->debugTrace;
    }

    private function addMarble(int $turn, int $currentMarble): int
    {
        $positionToSplice = ($currentMarble + 2) % \count($this->marbles);

        if ($positionToSplice === 0) {
            $positionToSplice = \count($this->marbles);
        }

        array_splice($this->marbles, $positionToSplice, 0, [$turn]);

        return $positionToSplice;
    }
}
