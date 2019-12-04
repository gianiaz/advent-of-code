<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day4;

use Jean85\AdventOfCode\Xmas2019\Day4\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /**
     * @dataProvider validPasswordProvider
     */
    public function testIsValid(int $value): void
    {
        $this->assertTrue((new Password($value))->isValid());
    }

    /**
     * @dataProvider invalidPasswordProvider
     */
    public function testIsInvalid(int $value): void
    {
        $this->assertFalse((new Password($value))->isValid());
    }

    public function validPasswordProvider(): array
    {
        return [
            [111111],
        ];
    }

    public function invalidPasswordProvider(): array
    {
        return [
            [223450],
            [123789],
        ];
    }
}
