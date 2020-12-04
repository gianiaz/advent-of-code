<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day4;

class PassportFactory
{
    private InputParser $inputParser;

    public function __construct(InputParser $inputParser)
    {
        $this->inputParser = $inputParser;
    }

    /**
     * @return \Generator<Passport>
     */
    public function create(string $input): \Generator
    {
        foreach ($this->inputParser->parse($input) as $passportData) {
            yield new Passport($passportData);
        }
    }
}
