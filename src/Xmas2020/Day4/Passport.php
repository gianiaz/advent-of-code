<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day4;

class Passport
{
    private const REQUIRED_FIELDS = [
        'byr', // Birth Year
        'iyr', // Issue Year
        'eyr', // Expiration Year
        'hgt', // Height
        'hcl', // Hair Color
        'ecl', // Eye Color
        'pid', // Passport ID
        // 'cid', // Country ID, not required really
    ];
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function isValid(): bool
    {
        foreach (self::REQUIRED_FIELDS as $fieldName) {
            if (! array_key_exists($fieldName, $this->data)) {
                return false;
            }
        }

        return true;
    }
}
