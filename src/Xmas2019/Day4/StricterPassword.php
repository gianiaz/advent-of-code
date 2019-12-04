<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day4;

class StricterPassword extends Password
{
    public function isValid(): bool
    {
        $passwordString = (string) $this->getPassword();
        $previousIdenticalDigits = 0;
        $doubleDigitFound = false;

        for ($i = 0; $i < 5; ++$i) {
            $firstChar = $passwordString[$i];
            $secondChar = $passwordString[$i + 1];

            // no decreasing numbers
            if ((int) $firstChar > (int) $secondChar) {
                return false;
            }

            if ($firstChar === $secondChar) {
                ++$previousIdenticalDigits;
            } else {
                if ($previousIdenticalDigits === 1) {
                    $doubleDigitFound = true;
                }

                $previousIdenticalDigits = 0;
            }
        }

        return $doubleDigitFound || $previousIdenticalDigits === 1;
    }
}
