<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day20;

class Node
{
    public int $remainingSwaps;
    public self $prev;
    public self $next;

    public function __construct(
        public int $value,
        private readonly int $decryptionKey
    ) {
        $this->resetSwapCount(1);
        $this->prev = $this;
        $this->next = $this;
    }

    public function resetSwapCount(int $count): void
    {
        $this->remainingSwaps = abs($this->value) * $this->decryptionKey;

        if ($count > 1) {
            $this->remainingSwaps %= $count;
        }
    }

    public function append(Node $newNode): void
    {
        $oldNext = $this->next;

        $this->next = $newNode;
        $newNode->prev = $this;

        $newNode->next = $oldNext;
        $oldNext->prev = $newNode;
    }

    public function swap(): void
    {
        if ($this->remainingSwaps === 0) {
            return;
        }

        --$this->remainingSwaps;

        if ($this->value > 0) {
            $swapWith = $this->next;

            $this->next = $swapWith->next;
            $swapWith->next->prev = $this;

            $swapWith->prev = $this->prev;
            $this->prev->next = $swapWith;

            $this->prev = $swapWith;
            $swapWith->next = $this;
        } else {
            $swapWith = $this->prev;

            $this->prev = $swapWith->prev;
            $swapWith->prev->next = $this;

            $swapWith->next = $this->next;
            $this->next->prev = $swapWith;

            $this->next = $swapWith;
            $swapWith->prev = $this;
        }
    }
}
