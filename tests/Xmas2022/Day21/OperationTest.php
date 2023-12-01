<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day21;

use Jean85\AdventOfCode\Xmas2022\Day21\Operation;
use Jean85\AdventOfCode\Xmas2022\Day21\UnresolvedMonkey;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testReverse(Operation $operation, int $expected, int $target, ?int $a, ?int $b): void
    {
        $a ??= $this->mockMonkey();
        $b ??= $this->mockMonkey();

        $this->assertSame($expected, $operation->reverse($target, $a, $b));
    }

    public function dataProvider(): array
    {
        return [
            [Operation::Add, 10, 20, null, 10],
            [Operation::Add, 10, 20, 10, null],
            [Operation::Multiply, 10, 100, 10, null],
            [Operation::Multiply, 10, 100, null, 10],
            [Operation::Subtract, 20, 10, null, 10],
            [Operation::Subtract, 10, 10, 20, null],
            [Operation::Divide, 10, 10, 100, null],
            [Operation::Divide, 100, 10, null, 10],
        ];
    }
    protected function mockMonkey(): UnresolvedMonkey
    {
        return new UnresolvedMonkey('foo', Operation::Subtract, 'bar');
    }
}
