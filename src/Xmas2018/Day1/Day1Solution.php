<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day1;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day1Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const INPUT = '+12 -10 -4 -8 +18 -1 -13 +10 -13 +5 +7 +6 +14 -9 -8 +7 +18 -11 +13 -1 +20 +11 +13 -2 +3 -8 -16 +4 -6 -3 -9 -12 +16 +17 -5 -11 +2 -20 -15 +5 +3 +11 -13 -18 -13 -6 -19 +6 -15 -11 +16 +1 +15 +5 -18 +14 -5 -15 -3 +11 -17 +19 +12 +5 +8 -2 +10 +13 +8 +19 +8 +17 -6 +8 +4 -9 +19 +13 +11 -2 +20 +3 -16 -18 +3 -5 -15 +18 +18 +9 -18 -19 +17 -16 +15 -12 +2 -20 +7 -3 -9 +10 +4 +20 -13 -17 -23 +7 +18 +21 +16 +17 +5 -14 +19 -18 -10 +7 +1 -13 +16 -21 +12 +19 +11 -5 +14 +11 -9 +19 -2 -7 +3 -20 +9 -16 +9 +10 +17 -18 -12 -11 -11 +20 -18 -12 -5 -7 +15 +20 +18 +23 +17 -7 +5 -7 +8 -2 -15 +5 -17 +1 -5 -8 +7 +15 +5 +1 +15 -11 -1 +17 +15 +18 +7 -3 -16 -7 +18 -6 +17 -2 +20 -2 -7 -17 +20 -1 +8 -16 -12 -6 -3 +19 +19 +18 -7 +17 +5 +19 -15 -13 +2 +14 +2 +1 +13 -7 +2 -10 -10 -15 +9 +9 +14 +7 +4 -15 -5 -17 -5 -9 +13 +6 +2 -15 -11 +17 -19 +14 -13 +3 +1 -18 -15 -17 -12 +13 -17 +5 -9 +2 +5 -8 -8 -19 +11 +20 +11 +16 -7 +20 +3 -21 -8 -11 -9 +8 -15 -20 -20 -17 +24 +17 -12 -20 -12 -3 +14 -18 +13 -74 -19 -13 +2 +23 -13 +24 -17 -5 +14 -10 -2 -10 -7 -6 -23 -10 -3 +9 -11 +8 +16 -8 -28 -10 +17 -9 -10 -9 -8 +2 +5 -19 +11 -16 +8 -14 -5 +8 +4 -3 +8 -7 +4 +1 -2 -7 +15 +3 +10 +4 +1 -14 -18 +15 -21 +3 +14 -15 -13 -14 -6 +15 +1 +11 +26 +19 -16 +5 -2 -9 +12 +19 -11 +23 -3 +15 -13 +14 -9 -26 +17 +63 -4 -20 -10 -39 -55 -6 -15 -9 -16 -17 -14 -12 +21 +1 -2 -16 -13 -21 +26 +27 +17 +6 +2 -18 +1 +18 +25 -3 +19 -35 -26 +4 -48 -3 +1 +20 +8 -27 -25 -8 -10 -24 +3 -61 +64 +17 +21 +84 +49 +4 -233 -2 +535 +55053 -1 -12 +2 -19 +13 +10 +10 +15 -12 +13 +15 +8 -15 -13 +10 -7 +3 -10 +16 +12 -6 +4 +3 +19 +14 +2 +10 +4 +16 -2 -8 +18 -14 -1 +4 -1 +15 +10 -6 +17 +17 +15 +8 +15 +6 +9 +19 -2 +13 -19 -15 -6 -15 -4 -10 -1 -4 -18 +15 -2 +3 +13 +5 +14 +15 -19 +7 +13 -14 -11 +10 +8 +13 -16 +5 -13 -16 +10 -5 -9 -1 +2 +15 -4 -19 -7 +19 +12 +24 +10 +10 +18 +15 +12 -5 -11 +5 +10 -12 -7 -14 +12 -17 -13 -20 +14 -13 +11 -16 +15 +15 +18 -8 +10 +17 +1 -10 +19 +8 +7 +4 +11 +11 -15 -13 +18 -17 +19 +5 -6 -9 +6 +18 -10 +9 -18 -17 -2 -14 -19 -1 -8 -10 -7 -18 +3 +14 +6 +14 -17 +18 +10 +23 +4 -14 +12 -4 -19 +15 +20 -5 +15 +16 -21 +14 -15 -17 -15 +7 +10 +18 +21 +14 +6 +4 +6 +17 -18 -14 -18 -8 +24 +10 +8 -13 +18 +3 -18 -2 -3 -8 -1 -1 -16 +9 -4 +10 +20 +18 +9 -1 +17 -2 +16 +16 -17 +13 +5 -6 -15 -19 +11 -17 -8 +10 -1 +10 -22 -15 +11 +20 -14 +2 +11 +17 +17 +18 -8 +7 +8 -14 +19 -6 +2 +10 +6 +5 +10 +3 -8 -4 -13 -15 -16 -5 -19 +16 -15 +5 -27 -18 +3 -7 +21 -8 -15 -4 -5 -8 +3 +22 +6 +8 +12 -27 +32 -4 +2 +4 -5 +26 -5 -3 -4 +21 +34 +4 -6 +17 -6 +7 +7 +10 -19 +20 +2 +14 +14 +17 +5 +16 -17 +11 -13 -5 +15 +7 -18 -9 -13 -2 -14 -2 -4 -3 -7 +12 +14 -9 +20 +7 +7 +15 +12 -3 -14 -1 +4 -16 +14 -3 -16 -8 +14 +18 +14 -5 -6 +7 +14 +16 -22 -16 -13 -9 -13 -1 -15 -9 -6 +20 +17 +1 -3 +44 +17 +17 +21 +9 +20 -17 +11 +10 -15 +10 +3 +4 +16 +8 -7 +17 +8 +15 -9 +4 +28 +8 -1 -6 -10 -65 +4 -42 -14 -14 -24 -15 +6 +13 -72 -1 -17 -5 +7 -27 +19 -21 -2 +20 -2 +3 -34 +30 +23 -30 -5 +20 -27 +11 -27 -7 -23 +39 -225 +15 +60 +472 +54569 +1 +15 +13 +6 -10 -13 -2 -6 +13 +2 +5 -10 -5 -11 -1 +18 -12 -15 -7 -1 +13 -18 -1 -5 -2 -14 -5 -4 -16 -10 +8 -1 +20 +11 +15 -3 -17 +8 +11 -6 -9 -8 -11 -1 -13 -3 -8 +12 +18 -11 -17 -12 +6 -7 -3 +15 +9 +13 -14 +18 +20 -6 -12 +2 +20 -12 -23 -17 -7 +1 -24 -17 -7 -18 +3 -13 +14 +2 -12 -16 +2 -35 -3 +2 -18 -14 -13 +10 -3 -17 +4 +23 +16 -7 -30 +29 -19 +18 -3 +20 -7 -3 +77 +1 +42 +18 +9 -1 +23 +57 +8 -12 +1 +5 +12 +3 +10 -1 +14 +20 -7 -3 -14 -12 +9 +16 +16 +12 +14 +11 +11 +2 +1 +19 -10 +18 -17 -9 -11 -8 +10 -1 -110292';
    /** @var string */
    private $input;

    /**
     * Day1Solution constructor.
     */
    public function __construct(string $input = self::INPUT)
    {
        $this->input = $input;
    }

    public function solve()
    {
        $frequency = 0;

        foreach ($this->getChanges() as $change) {
            $frequency += $this->convertToInteger($change);
        }

        return $frequency;
    }

    public function solveSecondPart()
    {
        $currentFrequency = 0;
        $reachedFrequencies = [
            0 => true,
        ];

        do {
            foreach ($this->getChanges() as $change) {
                $currentFrequency += $this->convertToInteger($change);

                if (isset($reachedFrequencies[$currentFrequency])) {
                    return $currentFrequency;
                }

                $reachedFrequencies[$currentFrequency] = true;
            }
        } while (true);
    }

    private function getChanges(): array
    {
        $changes = explode(' ', $this->input);

        return $changes;
    }

    private function convertToInteger($change): int
    {
        $integer = (int) substr($change, 1);
        if (\strpos($change, '-') === 0) {
            $integer *= -1;
        }

        return $integer;
    }
}
