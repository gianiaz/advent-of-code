<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day16;

use Jean85\AdventOfCode\Xmas2018\Day16\Day16Solution;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractWorkingOpcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Addition\Addi;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Assignment\Seti;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Multiplication\Mulr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Opcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Sample;
use PHPUnit\Framework\TestCase;

class Day16SolutionTest extends TestCase
{
    public function testOpcodeMatches(): void
    {
        $sample = $this->getDefaultSample();

        $opcodes = \array_values(\array_filter(Day16Solution::getDefaultWorkingOpcodes(), function (AbstractWorkingOpcode $opcode) use ($sample) {
            return $sample->getRegistersAfter() === $opcode->apply($sample->getOpcode(), $sample->getRegistersBefore());
        }));

        $this->assertCount(3, $opcodes);
        $this->assertInstanceOf(Addi::class, $opcodes[0]);
        $this->assertInstanceOf(Seti::class, $opcodes[1]);
        $this->assertInstanceOf(Mulr::class, $opcodes[2]);
    }

    public function testSolve(): void
    {
        $solution = new Day16Solution([$this->getDefaultSample()]);

        $this->assertSame(1, $solution->solve());
    }

    private function getDefaultSample(): Sample
    {
        return new Sample([3, 2, 1, 1], new Opcode(9, 2, 1, 2), [3, 2, 2, 1]);
    }
}
