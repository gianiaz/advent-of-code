<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day10;

use Jean85\AdventOfCode\Xmas2021\Day10\Day10Solution;
use PHPUnit\Framework\TestCase;

class Day10SolutionTest extends TestCase
{
    private const TEST_INPUT = '[({(<(())[]>[[{[]{<()<>>
[(()[<>])]({[<{<<[]>>(
{([(<{}[<>[]}>{[]{[(<()>
(((({<>}<{<{<>}{[]{[]{}
[[<[([]))<([[{}[[()]]]
[{[{({}]{}}([{[{{{}}([]
{<[[]]>}<{[{[{[]{()[[[]
[<(<(<(<{}))><([]([]()
<{([([[(<>()){}]>(<<{{
<{([{{}}[<[[[<>{}]]]>[]]';

    /**
     * @dataProvider corruptedLinesProvider
     */
    public function testIsCorrupted(string $line, bool $isCorrupted = false): void
    {
        $day10Solution = new Day10Solution();

        $result = $day10Solution->getFirstIllegalCharacter($line);

        if ($isCorrupted) {
            $this->assertNotNull($result);
        } else {
            $this->assertNull($result);
        }
    }

    public function corruptedLinesProvider(): array
    {
        return [
            ['([])'],
            ['{()()()}'],
            ['<([{}])>'],
            ['[<>({}){}[([])<>]]'],
            ['(((((((((())))))))))'],

            ['(]', true],
            ['{()()()>', true],
            ['(((()))}', true],
            ['<([]){()}[{}])', true],
        ];
    }

    public function test(): void
    {
        $day10Solution = new Day10Solution();

        $this->assertSame(26397, $day10Solution->solve(self::TEST_INPUT));
    }

    public function testSecondPart(): void
    {
        $day10Solution = new Day10Solution();

        $this->markTestIncomplete();
        $this->assertSame(1134, $day10Solution->solveSecondPart(self::TEST_INPUT));
    }
}
