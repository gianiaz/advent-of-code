<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

use Webmozart\Assert\Assert;

class SnailFishNumber implements SnailFishNumberInterface
{
    private ?self $up;
    public SnailFishNumberInterface $left;
    public SnailFishNumberInterface $right;

    public static function createFromInput(string $input): self
    {
        if ($input[0] !== '[') {
            throw new \InvalidArgumentException();
        }

        return new self(self::createStream(substr($input, 1)));
    }

    /**
     * @param resource $input
     */
    private function __construct($input, self $up = null)
    {
        $this->up = $up;

        $char = \Safe\fread($input, 1);

        if ($char === '[') {
            $this->left = new self($input, $this);
        } elseif (']' === $char) {
            if (! isset($this->right)) {
                throw new \RuntimeException('Parsing error, expecting right populated, got: ' . $char);
            }

            return;
        } elseif (is_numeric($char)) {
            $this->left = new NormalNumber((int) $char, $this);
        }

        if (',' !== $char = fread($input, 1)) {
            throw new \RuntimeException('Parsing error, expecting `,`, got: ' . $char);
        }

        if ('[' === $char = fread($input, 1)) {
            $this->right = new self($input, $this);
        } elseif (is_numeric($char)) {
            $this->right = new NormalNumber((int) $char, $this);
        } else {
            throw new \RuntimeException('Parsing error, expecting `]`, got: ' . $char);
        }

        if (']' !== $char = fread($input, 1)) {
            throw new \RuntimeException('Parsing error, expecting `]`, got: ' . $char);
        }
    }

    public function getMagnitude(): int
    {
        return  3 * $this->left->getMagnitude()
              + 2 * $this->right->getMagnitude();
    }

    public function reduce(int $nesting = 0): bool
    {
        if ($nesting === 4) {
            Assert::isInstanceOf($this->left, NormalNumber::class);
            Assert::isInstanceOf($this->right, NormalNumber::class);

            $this->up->goUpAndSumToTheLeft($this->left, $this);
            $this->up->goUpAndSumToTheRight($this->right, $this);

            if ($this->up->left === $this) {
                $this->up->left = new NormalNumber(0, $this->up);
            } else {
                $this->up->right = new NormalNumber(0, $this->up);
            }

            return true;
        }

        ++$nesting;

        return $this->left->reduce($nesting)
            || $this->right->reduce($nesting);
    }

    private function goUpAndSumToTheLeft(NormalNumber $number, self $prev): void
    {
        if ($this->left === $prev) {
            $this->up?->goUpAndSumToTheLeft($number, $this);
        } else {
            $this->left->goDownAndSumToTheRight($number);
        }
    }

    private function goUpAndSumToTheRight(NormalNumber $number, self $prev): void
    {
        if ($this->right === $prev) {
            $this->up?->goUpAndSumToTheRight($number, $this);
        } else {
            $this->right->goDownAndSumToTheLeft($number);
        }
    }

    public function goDownAndSumToTheLeft(NormalNumber $number): void
    {
        $this->left->goDownAndSumToTheLeft($number);
    }

    public function goDownAndSumToTheRight(NormalNumber $number): void
    {
        $this->right->goDownAndSumToTheRight($number);
    }

    public function __toString(): string
    {
        return '[' . $this->left . ',' . $this->right . ']';
    }

    /**
     * @return resource
     */
    private static function createStream(string $input)
    {
        $stream = fopen('php://memory', 'r+');
        if (false === $stream) {
            throw new \RuntimeException();
        }

        fwrite($stream, $input);
        rewind($stream);

        return $stream;
    }
}
