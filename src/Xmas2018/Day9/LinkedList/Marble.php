<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day9\LinkedList;

class Marble
{
    /** @var int */
    private $value;

    /** @var self */
    private $prev;

    /** @var self */
    private $next;

    /**
     * Marble constructor.
     */
    public function __construct(int $value)
    {
        $this->value = $value;
        $this->prev = $this;
        $this->next = $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getPrev(): Marble
    {
        return $this->prev;
    }

    public function setPrev(Marble $prev): void
    {
        $this->prev = $prev;
    }

    public function getNext(): Marble
    {
        return $this->next;
    }

    public function setNext(Marble $next): void
    {
        $this->next = $next;
    }

    public function addNewMarbleToTheRight(int $value): self
    {
        $newMarble = new self($value);
        $next = $this->getNext();

        $newMarble->setNext($next);
        $newMarble->setPrev($this);

        $next->setPrev($newMarble);
        $this->setNext($newMarble);

        return $newMarble;
    }

    public function removeFromTheLeft(): int
    {
        $marbleToBeDeleted = $this->getPrev();
        $score = $marbleToBeDeleted->getValue();

        $this->prev = $marbleToBeDeleted->getPrev();
        $this->getPrev()->setNext($this);

        $marbleToBeDeleted->value = null;
        $marbleToBeDeleted->prev = null;
        $marbleToBeDeleted->next = null;
        unset($marbleToBeDeleted);

        return $score;
    }
}
