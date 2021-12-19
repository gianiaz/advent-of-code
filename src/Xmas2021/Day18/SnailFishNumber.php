<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

use Webmozart\Assert\Assert;

class SnailFishNumber implements SnailFishNumberInterface
{
    private ?self $up;
    private SnailFishNumberInterface $left;
    private SnailFishNumberInterface $right;

    public static function createManually(SnailFishNumberInterface $left, SnailFishNumberInterface $right): self
    {
        $snailFishNumber = new self(null);
        $snailFishNumber->setLeft($left);
        $snailFishNumber->setRight($right);

        return $snailFishNumber;
    }

    public static function createFromInput(string $inputString): self
    {
        if ($inputString[0] !== '[') {
            throw new \InvalidArgumentException();
        }

        $input = self::createStream(substr($inputString, 1));

        return self::parse($input);
    }

    private static function parse($input, self $up = null): self
    {
        $snailFishNumber = new self($up);

        $char = \Safe\fread($input, 1);

        if ($char === '[') {
            $snailFishNumber->left = self::parse($input, $snailFishNumber);
        } elseif (']' === $char) {
            if (! isset($snailFishNumber->right)) {
                throw new \RuntimeException('Parsing error, expecting right populated, got: ' . $char);
            }

            return $snailFishNumber;
        } elseif (is_numeric($char)) {
            $snailFishNumber->left = new NormalNumber((int) $char, $snailFishNumber);
        }

        if (',' !== $char = fread($input, 1)) {
            throw new \RuntimeException('Parsing error, expecting `,`, got: ' . $char);
        }

        if ('[' === $char = fread($input, 1)) {
            $snailFishNumber->right = self::parse($input, $snailFishNumber);
        } elseif (is_numeric($char)) {
            $snailFishNumber->right = new NormalNumber((int) $char, $snailFishNumber);
        } else {
            throw new \RuntimeException('Parsing error, expecting `]`, got: ' . $char);
        }

        if (']' !== $char = fread($input, 1)) {
            throw new \RuntimeException('Parsing error, expecting `]`, got: ' . $char);
        }

        return $snailFishNumber;
    }

    private function __construct(?SnailFishNumber $up)
    {
        $this->up = $up;
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

    public function add(string $string): self
    {
        $addition = new self(null);
        $this->up = $addition;
        $addition->left = $this;
        $addition->right = self::createFromInput($string);
        $addition->right->up = $addition;

        while ($addition->reduce());

        return $addition;
    }

    public function setUp(self $up): void
    {
        Assert::isInstanceOf($up, self::class);
        $this->up = $up;
    }

    public function getLeft(): SnailFishNumberInterface
    {
        return $this->left;
    }

    public function setLeft(SnailFishNumberInterface $left): void
    {
        $this->left = $left;
        $left->setUp($this);
    }

    public function setRight(SnailFishNumberInterface $right): void
    {
        $this->right = $right;
        $right->setUp($this);
    }
}
