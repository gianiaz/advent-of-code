<?php

declare(strict_types=1);

namespace Tests\Xmas2017;

use Jean85\AdventOfCode\Xmas2017\Day4\Day4Solution;
use PHPUnit\Framework\TestCase;

class Day4SolutionTest extends TestCase
{
    /**
     * @dataProvider passPhraseProvider
     */
    public function testIsValid(string $passPhrase, bool $isValid)
    {
        $this->assertSame($isValid, (new Day4Solution([]))->isValid(explode(' ', $passPhrase)));
    }

    public function passPhraseProvider()
    {
        yield ['aa bb cc dd ee', true];
        yield ['aa bb cc dd aa', false];
        yield ['aa bb cc dd aaa', true];
    }

    /**
     * @dataProvider passPhraseWithPermutationsProvider
     */
    public function testIsValidWithPermutations(string $passPhrase, bool $isValid)
    {
        $this->assertSame($isValid, (new Day4Solution([]))->isValidWithPermutation(explode(' ', $passPhrase)));
    }

    public function passPhraseWithPermutationsProvider()
    {
        yield ['abcde fghij', true];
        yield ['abcde xyz ecdab', false];
        yield ['a ab abc abd abf abj', true];
        yield ['iiii oiii ooii oooi oooo', true];
        yield ['oiii ioii iioi iiio', false];
    }
}
