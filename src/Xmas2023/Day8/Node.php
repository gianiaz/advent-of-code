<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day8;

use Webmozart\Assert\Assert;

class Node
{
    private function __construct(
        public readonly string $name,
        public readonly string $left,
        public readonly string $right,
    ) {
        Assert::length($this->name, 3);
        Assert::length($this->left, 3);
        Assert::length($this->right, 3);
    }

    public static function parse(string $input): self
    {
        \Safe\preg_match('/^(\w{3}) = \((\w{3}), (\w{3})\)$/', trim($input), $matches);

        return new self(
            $matches[1],
            $matches[2],
            $matches[3],
        );
    }

    public function getNext(Direction $instruction): string
    {
        return match ($instruction) {
            Direction::Left => $this->left,
            Direction::Right => $this->right,
        };
    }
}
