<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day2;

use Jean85\AdventOfCode\Xmas2018\Day2\BoxId;
use PHPUnit\Framework\TestCase;

class BoxIdTest extends TestCase
{
    /**
     * @dataProvider multipleCharsDataProvider
     */
    public function testGetCharIndex(string $id, bool $isCountedTwice, bool $isCountedThrice): void
    {
        $boxId = new BoxId($id);

        $this->assertSame($isCountedTwice, $boxId->isCountedTwice(), print_r($boxId->getCharIndex(), true));
        $this->assertSame($isCountedThrice, $boxId->isCountedThrice(), print_r($boxId->getCharIndex(), true));
    }

    public function multipleCharsDataProvider()
    {
        return [
            ['abcdef', false, false],
            ['bababc', true, true],
            ['abbcde', true, false],
            ['aabcdd', true, false],
            ['abcdee', true, false],
            ['ababab', false, true],
        ];
    }

    /**
     * @dataProvider isSimilarDataProvider
     */
    public function testIsSimilarTo(string $firstId, string $secondId, bool $isSimilar): void
    {
        $boxId1 = new BoxId($firstId);
        $boxId2 = new BoxId($secondId);

        $this->assertSame($isSimilar, $boxId1->isSimilarTo($boxId2));
    }

    public function isSimilarDataProvider()
    {
        return [
            ['abcde', 'axcye', false],
            ['fghij', 'fguij', true],
            ['dghfbsyizizumkjlxevacpxqtr', 'ighfbsyizxoumkjlxevacpzqtr', false],
        ];
    }
}
