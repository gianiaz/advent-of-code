<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day2;

class BoxId
{
    /** @var string */
    private $id;

    /** @var int[] */
    private $charIndex;

    /**
     * BoxId constructor.
     */
    public function __construct(string $id)
    {
        $this->id = $id;
        $this->charIndex = $this->createCharIndex($this->id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCharIndex(): array
    {
        return $this->charIndex;
    }

    public function isCountedTwice(): bool
    {
        foreach ($this->charIndex as $char => $count) {
            if ($count === 2) {
                return true;
            }
        }

        return false;
    }

    public function isCountedThrice(): bool
    {
        foreach ($this->charIndex as $char => $count) {
            if ($count === 3) {
                return true;
            }
        }

        return false;
    }

    private function createCharIndex(string $id): array
    {
        $index = [];

        foreach (str_split($id) as $char) {
            if (! array_key_exists($char, $index)) {
                $index[$char] = 0;
            }

            ++$index[$char];
        }

        return $index;
    }
}
