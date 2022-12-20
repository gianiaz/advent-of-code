<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day20;

class EncryptedCoordinates
{
    /** @var Node[] */
    private array $nodes = [];
    private Node $firstNode;
    private Node $nodeZero;

    public function __construct(string $input)
    {
        $prevNode = null;

        foreach (explode(PHP_EOL, $input) as $value) {
            if (! is_numeric($value)) {
                throw new \InvalidArgumentException('Invalid value ' . $value);
            }

            $newNode = new Node((int) $value);
            $prevNode?->append($newNode);

            $this->firstNode ??= $newNode;
            $this->nodes[] = $newNode;

            $prevNode = $newNode;

            if ($newNode->value === 0) {
                $this->nodeZero = $newNode;
            }
        }
    }

    public function getNode(int $i): Node
    {
        $node = $this->nodeZero;

        while ($i--) {
            $node = $node->next;
        }

        return $node;
    }

    /**
     * @return int[]
     */
    public function getStatus(): array
    {
        $result = [];
        $currentNode = $this->firstNode;

        do {
            $result[] = $currentNode->value;
            $currentNode = $currentNode->next;
        } while ($currentNode !== $this->firstNode);

        return $result;
    }

    public function swapOneNode(): ?Node
    {
        $node = $this->getFirstNodeToBeSwapped();
        if (null === $node) {
            return null;
        }

        while ($node->remainingSwaps) {
            if ($node === $this->firstNode) {
                $this->firstNode = match (true) {
                    $node->value > 0 => $node->next,
                    $node->value < 0 => $node->prev,
                };
            }

            $node->swap();
        }

        return $node;
    }

    private function getFirstNodeToBeSwapped(): ?Node
    {
        foreach ($this->nodes as $node) {
            if ($node->remainingSwaps !== 0) {
                return $node;
            }
        }

        return null;
    }
}
