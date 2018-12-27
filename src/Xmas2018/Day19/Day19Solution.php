<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day19;

use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\AbstractWorkingOpcode;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Addition\Addi;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Addition\Addr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Assignment\Seti;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Assignment\Setr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\BitwiseAnd\Bani;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\BitwiseAnd\Banr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\BitwiseOr\Bori;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\BitwiseOr\Borr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Equality\Eqir;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Equality\Eqri;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Equality\Eqrr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\GreaterThan\Gtir;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\GreaterThan\Gtri;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\GreaterThan\Gtrr;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Multiplication\Muli;
use Jean85\AdventOfCode\Xmas2018\Day16\Opcode\Multiplication\Mulr;

class Day19Solution
{
    /** @var Opcode[] */
    private $opcodes;

    /** @var int */
    private $ip;

    /** @var int[] */
    private $registers;

    /** @var AbstractWorkingOpcode[] */
    private $workers;

    public function __construct(array $opcodes = null, int $ip = 3)
    {
        $this->opcodes = $opcodes ?? $this->getInput();
        $this->ip = $ip;
        $this->registers = \array_fill(0, 6, 0);
        $this->workers = $this->initWorkers();
    }

    /**
     * @return int[]
     */
    public function getRegisters(): array
    {
        return $this->registers;
    }

    private function getCurrentInstruction(): Opcode
    {
        return $this->opcodes[$this->ip];
    }

    public function step(): bool
    {
        $currentInstruction = $this->getCurrentInstruction();
        $this->registers[0] = $this->ip;
        $this->execute($currentInstruction);
        ++$this->ip;

        return true;
    }

    private function execute(Opcode $currentInstruction): void
    {
        $worker = $this->workers[$currentInstruction->getCode()];
        $this->registers = $worker->apply($currentInstruction, $this->registers);
    }

    private function initWorkers(): array
    {
        return [
            'addi' => new Addi(),
            'addr' => new Addr(),
            'seti' => new Seti(),
            'setr' => new Setr(),
            'bani' => new Bani(),
            'banr' => new Banr(),
            'bori' => new Bori(),
            'borr' => new Borr(),
            'eqir' => new Eqir(),
            'eqri' => new Eqri(),
            'eqrr' => new Eqrr(),
            'gtir' => new Gtir(),
            'gtri' => new Gtri(),
            'gtrr' => new Gtrr(),
            'mulr' => new Mulr(),
            'muli' => new Muli(),
        ];
    }

    private function getInput(): array
    {
        return [
            new Opcode('addi', 3, 16, 3),
            new Opcode('seti', 1, 8, 4),
            new Opcode('seti', 1, 4, 5),
            new Opcode('mulr', 4, 5, 1),
            new Opcode('eqrr', 1, 2, 1),
            new Opcode('addr', 1, 3, 3),
            new Opcode('addi', 3, 1, 3),
            new Opcode('addr', 4, 0, 0),
            new Opcode('addi', 5, 1, 5),
            new Opcode('gtrr', 5, 2, 1),
            new Opcode('addr', 3, 1, 3),
            new Opcode('seti', 2, 1, 3),
            new Opcode('addi', 4, 1, 4),
            new Opcode('gtrr', 4, 2, 1),
            new Opcode('addr', 1, 3, 3),
            new Opcode('seti', 1, 3, 3),
            new Opcode('mulr', 3, 3, 3),
            new Opcode('addi', 2, 2, 2),
            new Opcode('mulr', 2, 2, 2),
            new Opcode('mulr', 3, 2, 2),
            new Opcode('muli', 2, 11, 2),
            new Opcode('addi', 1, 3, 1),
            new Opcode('mulr', 1, 3, 1),
            new Opcode('addi', 1, 17, 1),
            new Opcode('addr', 2, 1, 2),
            new Opcode('addr', 3, 0, 3),
            new Opcode('seti', 0, 3, 3),
            new Opcode('setr', 3, 0, 1),
            new Opcode('mulr', 1, 3, 1),
            new Opcode('addr', 3, 1, 1),
            new Opcode('mulr', 3, 1, 1),
            new Opcode('muli', 1, 14, 1),
            new Opcode('mulr', 1, 3, 1),
            new Opcode('addr', 2, 1, 2),
            new Opcode('seti', 0, 8, 0),
            new Opcode('seti', 0, 9, 3),
        ];
    }
}
