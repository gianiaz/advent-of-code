<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day2;

use Jean85\AdventOfCode\Xmas2020\Day2\Password;
use Jean85\AdventOfCode\Xmas2020\Day2\Policy;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /**
     * @dataProvider passwordProvider
     */
    public function testIsValidWithTheNewPolicy(bool $shouldBeValid, Password $password): void
    {
        $this->assertSame($shouldBeValid, $password->isValidWithTheNewPolicy());
    }

    public function passwordProvider(): array
    {
        return [
            [true, new Password('abcde', new Policy('a', 1, 3))],
            [false, new Password('cdefg', new Policy('b', 1, 3))],
            [false, new Password('ccccccccc', new Policy('b', 2, 9))],
        ];
    }
}
