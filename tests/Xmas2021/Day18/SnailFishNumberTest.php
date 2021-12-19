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
    public function testCreationAndToString(string $input): void
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
            ['[[1,2],3]'],
            ['[9,[8,7]]'],
            ['[[1,9],[8,5]]'],
            ['[[[[1,2],[3,4]],[[5,6],[7,8]]],9]'],
            ['[[[9,[3,8]],[[0,9],6]],[[[3,7],[4,9]],3]]'],
            ['[[[[1,3],[5,3]],[[1,3],[8,7]]],[[[4,9],[6,9]],[[8,2],[7,3]]]]'],
            ['[7,[[[3,7],[4,3]],[[6,3],[8,8]]]]'],
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

    /**
     * @dataProvider magnitudeDataProvider
     */
    public function testGetMagnitude(int $expectedMagnitude, string $input): void
    {
        $snailFishNumber = SnailFishNumber::createFromInput($input);

        $this->assertSame($expectedMagnitude, $snailFishNumber->getMagnitude());
    }

    /**
     * @return array{int, string}[]
     */
    public function magnitudeDataProvider(): array
    {
        return [
            [29, '[9,1]'],
            [21, '[1,9]'],
            [129, '[[9,1],[1,9]]'],
            [143, '[[1,2],[[3,4],5]]'],
            [1384, '[[[[0,7],4],[[7,8],[6,0]]],[8,1]]'],
            [445, '[[[[1,1],[2,2]],[3,3]],[4,4]]'],
            [791, '[[[[3,0],[5,3]],[4,4]],[5,5]]'],
            [1137, '[[[[5,0],[7,4]],[5,5]],[6,6]]'],
            [3488, '[[[[8,7],[7,7]],[[8,6],[7,7]]],[[[0,7],[6,6]],[8,7]]]'],
        ];
    }

    /**
     * @dataProvider explodingNumbersDataProvider
     */
    public function testExplode(string $input, string $reducedNumber): void
    {
        $snailFishNumber = SnailFishNumber::createFromInput($input);

        $this->assertTrue($snailFishNumber->reduce());

        $this->assertSame($reducedNumber, $snailFishNumber->__toString());
    }

    /**
     * @return array{string, string}[]
     */
    public function explodingNumbersDataProvider(): array
    {
        return [
            ['[[[[[9,8],1],2],3],4]', '[[[[0,9],2],3],4]'],
            ['[7,[6,[5,[4,[3,2]]]]]', '[7,[6,[5,[7,0]]]]'],
            ['[[6,[5,[4,[3,2]]]],1]', '[[6,[5,[7,0]]],3]'],
            ['[[3,[2,[1,[7,3]]]],[6,[5,[4,[3,2]]]]]', '[[3,[2,[8,0]]],[9,[5,[4,[3,2]]]]]'],
            ['[[3,[2,[8,0]]],[9,[5,[4,[3,2]]]]]', '[[3,[2,[8,0]]],[9,[5,[7,0]]]]'],
        ];
    }

    public function testAddition(): void
    {
        $snailFishNumber = SnailFishNumber::createFromInput('[1,1]')
            ->add('[2,2]')
            ->add('[3,3]')
            ->add('[4,4]')
        ;

        $this->assertSame('[[[[1,1],[2,2]],[3,3]],[4,4]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[5,5]');

        $this->assertSame('[[[[3,0],[5,3]],[4,4]],[5,5]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[6,6]');

        $this->assertSame('[[[[5,0],[7,4]],[5,5]],[6,6]]', $snailFishNumber->__toString());
    }

    public function testAdditionBis(): void
    {
        $snailFishNumber = SnailFishNumber::createFromInput('[[[0,[4,5]],[0,0]],[[[4,5],[2,6]],[9,5]]]');

        $snailFishNumber = $snailFishNumber->add('[7,[[[3,7],[4,3]],[[6,3],[8,8]]]]');

        $this->assertSame('[[[[4,0],[5,4]],[[7,7],[6,0]]],[[8,[7,7]],[[7,9],[5,0]]]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[[2,[[0,8],[3,4]]],[[[6,7],1],[7,[1,6]]]]');
        $this->assertSame('[[[[6,7],[6,7]],[[7,7],[0,7]]],[[[8,7],[7,7]],[[8,8],[8,0]]]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[[[[2,4],7],[6,[0,5]]],[[[6,8],[2,8]],[[2,1],[4,5]]]]');
        $this->assertSame('[[[[7,0],[7,7]],[[7,7],[7,8]]],[[[7,7],[8,8]],[[7,7],[8,7]]]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[7,[5,[[3,8],[1,4]]]]');
        $this->assertSame('[[[[7,7],[7,8]],[[9,5],[8,7]]],[[[6,8],[0,8]],[[9,9],[9,0]]]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[[2,[2,2]],[8,[8,1]]]');
        $this->assertSame('[[[[6,6],[6,6]],[[6,0],[6,7]]],[[[7,7],[8,9]],[8,[8,1]]]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[2,9]');
        $this->assertSame('[[[[6,6],[7,7]],[[0,7],[7,7]]],[[[5,5],[5,6]],9]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[1,[[[9,3],9],[[9,0],[0,7]]]]');
        $this->assertSame('[[[[7,8],[6,7]],[[6,8],[0,8]]],[[[7,7],[5,0]],[[5,5],[5,6]]]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[[[5,[7,4]],7],1]');
        $this->assertSame('[[[[7,7],[7,7]],[[8,7],[8,7]]],[[[7,0],[7,7]],9]]', $snailFishNumber->__toString());

        $snailFishNumber = $snailFishNumber->add('[[[[4,2],2],6],[8,7]]');
        $this->assertSame('[[[[8,7],[7,7]],[[8,6],[7,7]]],[[[0,7],[6,6]],[8,7]]]', $snailFishNumber->__toString());
    }
}
