<?php

namespace Jean85\AdventOfCode\Xmas2022\Day3;

class RuckSack
{
    public readonly string $firstCompartment;
    public readonly string $secondCompartment;

    public function __construct(string $input)
    {
        $length = floor(strlen($input) / 2);
        
        $this->firstCompartment = substr($input, 0, $length);
        $this->secondCompartment = substr($input, $length);
    }

    public function getPriority(): int
    {
        $inFirst = array_unique(str_split($this->firstCompartment));
        $inSecond = array_unique(str_split($this->secondCompartment));
        
        $priority = 0;
        foreach (array_intersect($inFirst, $inSecond) as $commonItem) {
            $priority += self::convertToPriority($commonItem);
        }
        
        return $priority;
    }

    public static function convertToPriority(string $item): int
    {
        if (strlen($item) !== 1) {
            throw new \InvalidArgumentException('Unexpected item: ' . $item);
        } 

        if (ctype_upper($item)) {
            return 27 + ord($item) - ord('A');
        } else {
            return 1 + ord($item) - ord('a');
        }
    }
}
