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

        $this->assertArrayHasKey('char', $result);
        $this->assertArrayHasKey('position', $result);
        if ($isCorrupted) {
            $this->assertNotNull($result['char']);
            $this->assertNotNull($result['position']);
        } else {
            $this->assertNull($result['char']);
            $this->assertNull($result['position']);
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

    /**
     * @dataProvider incompleteLinesProvider
     */
    public function testGetExpected(string $line, string $expected): void
    {
        $day10Solution = new Day10Solution();

        $result = $day10Solution->getFirstIllegalCharacter($line);

        $this->assertArrayHasKey('expected', $result);
        $this->assertEquals($expected, $result['expected']);
    }

    /**
     * @return array{string, string}[]
     */
    public function incompleteLinesProvider(): array
    {
        return [
            ['[({(<(())[]>[[{[]{<()<>>', '}}]])})]'],
            ['[(()[<>])]({[<{<<[]>>(', ')}>]})'],
            ['(((({<>}<{<{<>}{[]{[]{}', '}}>}>))))'],
            ['{<[[]]>}<{[{[{[]{()[[[]', ']]}}]}]}>'],
            ['<{([{{}}[<[[[<>{}]]]>[]]', '])}>'],
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

        $this->assertSame(288957, $day10Solution->solveSecondPart(self::TEST_INPUT));
    }
}
