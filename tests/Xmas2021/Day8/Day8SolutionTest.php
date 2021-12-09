<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day8;

use Jean85\AdventOfCode\Xmas2021\Day8\Day8Solution;
use PHPUnit\Framework\TestCase;

class Day8SolutionTest extends TestCase
{
    private const TEST_REDUCED_INPUT = 'acedgfb cdfbe gcdfa fbcad dab cefabd cdfgeb eafb cagedb ab | cdfeb fcadb cdfeb cdbaf';
    private const TEST_INPUT = 'be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe
edbfga begcd cbg gc gcadebf fbgde acbgfd abcde gfcbed gfec | fcgedb cgb dgebacf gc
fgaebd cg bdaec gdafb agbcfd gdcbef bgcad gfac gcb cdgabef | cg cg fdcagb cbg
fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb
aecbfdg fbg gf bafeg dbefa fcge gcbea fcaegb dgceab fcbdga | gecf egdcabf bgf bfgea
fgeab ca afcebg bdacfeg cfaedg gcfdb baec bfadeg bafgc acf | gebdcfa ecba ca fadegcb
dbcfg fgd bdegcaf fgec aegbdf ecdfab fbedc dacgb gdcebf gf | cefg dcbef fcge gbcadfe
bdfegc cbegaf gecbf dfcage bdacg ed bedf ced adcbefg gebcd | ed bcgafe cdgba cbgef
egadfb cdbfeg cegd fecab cgb gbdefca cg fgcdab egfdb bfceg | gbdfcae bgc cg cgb
gcafb gcf dcaebfg ecagb gf abcdeg gaef cafbge fdbac fegbdc | fgae cfgab fg bagce';

    public function test(): void
    {
        $day8Solution = new Day8Solution();

        $this->assertSame(26, $day8Solution->solve(self::TEST_INPUT));
    }

    /**
     * @dataProvider secondPartProvider
     */
    public function testSecondPart(string $input, int $expected): void
    {
        $day8Solution = new Day8Solution();

        $this->assertSame($expected, $day8Solution->solveSecondPart($input));
    }

    public function secondPartProvider(): array
    {
        return [
            [self::TEST_REDUCED_INPUT, 5353],
            [self::TEST_INPUT, 61229],
        ];
    }
}
