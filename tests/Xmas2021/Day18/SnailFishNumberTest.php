<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day18;

use Jean85\AdventOfCode\Xmas2021\Day18\SnailFishNumber;
use PHPUnit\Framework\TestCase;

class SnailFishNumberTest extends TestCase
{
    /**
     * @dataProvider snailFishNumberInputDataProvider
     * @dataProvider inputDataProvider
     */
    public function testCreationAndStringable(string $input): void
    {
        $snailFishNumber = SnailFishNumber::createFromInput($input);

        $this->assertSame($input, $snailFishNumber->__toString());
    }

    /**
     * @return array{string}[]
     */
    public function snailFishNumberInputDataProvider(): array
    {
        return [
            ['[1,2]'],
            ['[1,[2,3]]'],
            ['[[1,[2,3]],4]'],
            ['[[[[4,3],4],4],[7,[[8,4],9]]]'],
        ];
    }

    /**
     * @return \Generator<array{string}>
     */
    public function inputDataProvider(): \Generator
    {
        $input = trim(file_get_contents(dirname(__DIR__, 3) . '/src/Xmas2021/Day18/input.txt'));

        foreach (explode(PHP_EOL, $input) as $number) {
            yield [$number];
        }
    }
}
