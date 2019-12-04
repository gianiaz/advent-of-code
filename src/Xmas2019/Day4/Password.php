<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day4;

class Password
{
    /** @var int */
    private $password;

    public function __construct(int $password)
    {
        $this->password = $password;
    }

    public function next(): self
    {
        return new static($this->password + 1);
    }

    public function getPassword(): int
    {
        return $this->password;
    }

    public function isValid(): bool
    {
        $passwordString = (string) $this->password;
        $doubleDigit = false;

        for ($i = 0; $i < 5; ++$i) {
            $secondChar = $passwordString[$i + 1];
            $firstChar = $passwordString[$i];

            // no decreasing numbers
            if ((int) $firstChar > (int) $secondChar) {
                return false;
            }

            if (! $doubleDigit) {
                $doubleDigit = $firstChar === $secondChar;
            }
        }

        return $doubleDigit;
    }
}
