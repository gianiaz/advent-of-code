<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day4;

class InputParser
{
    /**
     * @return array{
     *      byr?: string Birth Year
     *      iyr?: string Issue Year
     *      eyr?: string Expiration Year
     *      hgt?: string Height
     *      hcl?: string Hair Color
     *      ecl?: string Eye Color
     *      pid?: string Passport ID
     *      cid?: string Country ID
     * }
     */
    public function parse(string $input): array
    {
        $passportsRawData = explode("\n\n", $input);
        $passportsData = [];

        foreach ($passportsRawData as $passportsRawDatum) {
            preg_match_all('/(\w+):([\w#]+)/', $passportsRawDatum, $matches);
            $newPassport = [];
            foreach ($matches[0] as $i => $match) {
                $newPassport[$matches[1][$i]] = $matches[2][$i];
            }
            $passportsData[] = $newPassport;
        }

        return $passportsData;
    }
}
