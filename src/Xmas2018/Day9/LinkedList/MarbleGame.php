<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9\LinkedList;

class MarbleGame
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

    public function play(): int
    {
        $currentMarble = new Marble(0);
        $currentPlayer = 0;

        $this->addDebugTrace($currentMarble, $currentPlayer);

        $currentMarble = $currentMarble->addNewMarbleToTheRight(++$this->turn);
        ++$currentPlayer;

        $this->addDebugTrace($currentMarble, $currentPlayer);
        do {
            $currentPlayer = ($currentPlayer + 1) % \count($this->players);
            if ($currentPlayer === 0) {
                $currentPlayer = \count($this->players);
            }

            ++$this->turn;

            if ($this->turn % 23 === 0) {
                $currentMarble = $currentMarble->getPrev()
                    ->getPrev()
                    ->getPrev()
                    ->getPrev()
                    ->getPrev()
                    ->getPrev(); // 6

                $this->players[$currentPlayer] += $this->turn + $currentMarble->removeFromTheLeft();
            } else {
                $currentMarble = $currentMarble->getNext()->addNewMarbleToTheRight($this->turn);
            }

            if ($this->turn % 10000 === 0) {
                echo date('H:i:s ') . $this->turn . PHP_EOL;
            }

            $this->addDebugTrace($currentMarble, $currentPlayer);
        } while ($this->turn < $this->lastMarble);

        return max($this->players);
    }

    private function addDebugTrace(Marble $currentMarble, int $currentPlayer): void
    {
        if (! $this->debug) {
            return;
        }

        $debugTrace = sprintf('[%d]  ', $currentPlayer);

        $iterationLimit = $currentMarble->getValue();

        do {
            $currentMarble = $currentMarble->getNext();
            $debugTrace .= ' ' . $currentMarble->getValue();
        } while ($iterationLimit !== $currentMarble->getValue());

        $debugTrace .= '<';

        $this->debugTrace[] = preg_replace('/\s+/', ' ', $debugTrace);
    }

    public function enableDebug(): void
    {
        $this->debug = true;
    }

    public function getDebugTrace(): array
    {
        return $this->debugTrace;
    }
}
