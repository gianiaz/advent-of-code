<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day18;

class SnailFishNumber
{
    private self|int $left;
    private self|int $right;

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
    private function __construct($input)
    {
        $char = \Safe\fread($input, 1);

        if ($char === '[') {
            $this->left = new self($input);
        } elseif (']' === $char) {
            if (isset($this->right)) {
                return;
            } else {
                throw new \RuntimeException('Parsing error, expecting right populated, got: ' . $char);
            }
        } elseif (is_numeric($char)) {
            $this->left = (int) $char;
        }

        if (',' !== $char = fread($input, 1)) {
            throw new \RuntimeException('Parsing error, expecting `,`, got: ' . $char);
        }

        if ('[' === $char = fread($input, 1)) {
            $this->right = new self($input);
        } elseif (is_numeric($char)) {
            $this->right = (int) $char;
        } else {
            throw new \RuntimeException('Parsing error, expecting `]`, got: ' . $char);
        }

        if (']' !== $char = fread($input, 1)) {
            throw new \RuntimeException('Parsing error, expecting `]`, got: ' . $char);
        }
    }

    public function getMagnitude(): int
    {
        if ($this->left instanceof self) {
            $leftMagnitude = 3 * $this->left->getMagnitude();
        } else {
            $leftMagnitude = 3 * $this->left;
        }

        if ($this->right instanceof self) {
            $rightMagnitude = 2 * $this->right->getMagnitude();
        } else {
            $rightMagnitude = 2 * $this->right;
        }

        return $leftMagnitude + $rightMagnitude;
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
