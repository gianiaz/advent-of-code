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

    public function hasAllRequiredField(): bool
    {
        foreach (self::REQUIRED_FIELDS as $fieldName) {
            if (! array_key_exists($fieldName, $this->data)) {
                return false;
            }
        }

        return true;
    }

    public function hasValidData(): bool
    {
        if (! $this->hasAllRequiredField()) {
            return false;
        }

        foreach ($this->getValidationCallbacks() as $validation) {
            if (! $validation($this->data)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return (callable(array $data):bool)[]
     */
    private function getValidationCallbacks(): array
    {
        return [
            function (array $data): bool {
                $byr = (int) $data['byr'];

                return 1920 <= $byr && $byr <= 2002;
            },
            function (array $data): bool {
                $iyr = (int) $data['iyr'];

                return 2010 <= $iyr && $iyr <= 2020;
            },
            function (array $data): bool {
                $eyr = (int) $data['eyr'];

                return 2020 <= $eyr && $eyr <= 2030;
            },
            function (array $data): bool {
                if (1 !== preg_match('/(\d+)(cm|in)/', $data['hgt'], $matches)) {
                    return false;
                }
                $measure = $matches[1];
                $unit = $matches[2];

                switch ($unit) {
                    case 'in':
                        return 59 <= $measure && $measure <= 76;
                    case 'cm':
                        return 150 <= $measure && $measure <= 193;
                    default:
                        throw new \InvalidArgumentException('Unrecognized measure: ' . print_r($unit, true));
                }
            },
            function (array $data): bool {
                return 1 === preg_match('/^#[\da-f]{6}$/', $data['hcl'] ?? '');
            },
            function (array $data): bool {
                return 1 === preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $data['ecl'] ?? '');
            },
            function (array $data): bool {
                return 1 === preg_match('/^\d{9}$/', $data['pid'] ?? '');
            },
        ];
    }
}
