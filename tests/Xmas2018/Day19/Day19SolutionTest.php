<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day19;

use Jean85\AdventOfCode\Xmas2018\Day19\Day19Solution;
use Jean85\AdventOfCode\Xmas2018\Day19\Opcode;
use PHPUnit\Framework\TestCase;

class Day19SolutionTest extends TestCase
{
    public function testStep(): void
    {
        $opcodes = [
            new Opcode('seti', 5, 0, 1),
            new Opcode('seti', 6, 0, 2),
            new Opcode('addi', 0, 1, 0),
            new Opcode('addr', 1, 2, 3),
            new Opcode('setr', 1, 0, 0),
            new Opcode('seti', 8, 0, 4),
            new Opcode('seti', 9, 0, 5),
        ];
        $solution = new Day19Solution($opcodes, 0);

        $this->assertSame([0, 0, 0, 0, 0, 0], $solution->getRegisters());

        $this->assertTrue($solution->step());

        $this->assertSame([0, 5, 0, 0, 0, 0], $solution->getRegisters());

        $this->assertTrue($solution->step());

        $this->assertSame([1, 5, 6, 0, 0, 0], $solution->getRegisters());

        $this->assertTrue($solution->step());

        $this->assertSame([3, 5, 6, 0, 0, 0], $solution->getRegisters());

        $this->assertTrue($solution->step());

        $this->assertSame([5, 5, 6, 0, 0, 0], $solution->getRegisters());

        $this->assertTrue($solution->step());

        $this->assertSame([6, 5, 6, 0, 0, 9], $solution->getRegisters());
    }
}
