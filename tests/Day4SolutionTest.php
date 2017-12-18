<?php

namespace Tests;

use Jean85\AdventOfCode\Day4\Day4Solution;
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
}
