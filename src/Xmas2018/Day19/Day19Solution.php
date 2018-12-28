<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day19;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;
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

class Day19Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var Opcode[] */
    private $opcodes;

    /** @var int */
    private $instructionPointer;

    /** @var int */
    private $ipBoundTo;

    /** @var int[] */
    private $registers;

    /** @var AbstractWorkingOpcode[] */
    private $workers;

    public function __construct(array $opcodes = null, int $ipBoundTo = 3)
    {
        $this->opcodes = $opcodes ?? $this->getInput();
        $this->instructionPointer = 0;
        $this->ipBoundTo = $ipBoundTo;
        $this->registers = \array_fill(0, 6, 0);
        $this->workers = $this->initWorkers();
    }

    public function solve()
    {
        $count = 0;
        do {
            echo $count . ' -- ' . $this->instructionPointer . ":\t" . implode("\t", $this->registers) . PHP_EOL;

            $this->step();
        } while ($count++ <= 0);

        return $this->registers[0];
    }

    public function solveSecondPart()
    {
        $count = 0;
        $this->registers[0] = 1;
        do {
            echo $count . ' -- ' . $this->instructionPointer . ":\t" . implode("\t", $this->registers) . PHP_EOL;

            $this->step();
        } while ($count++ <= 50);

        return $this->registers[0];
    }

    public function runNormally(int $upUntilSteps)
    {
        $count = 0;
        do {
            echo $this->instructionPointer . ': ' . implode("\t", $this->registers) . PHP_EOL;
            if ($count++ > $upUntilSteps) {
                return $this->registers;
            }
        } while ($this->step());

        return $this->registers[0];
    }

    public function runOptmimized(int $upUntilSteps = 738000000000)
    {
        $count = 21;
        $this->registers = [0, 0, 919, 2, 1, 2];
        $this->instructionPointer = 3;
        
        do {
            echo $count . ' -- ' . $this->instructionPointer . ': ' . implode("\t", $this->registers) . PHP_EOL;
            if ($this->registers[4] * $this->registers[5] === 919) {
                $this->registers[0]++;
                $this->registers[4]++;
                $this->registers[5] = 1;
                $count += 11;
                
                continue;
            }

            if ($this->registers[4] * $this->registers[5] !== 919) {
                $this->registers[5]++;
                $count += 8;
                continue;
            }

            $this->step();
            $count++;
        } while($count <= $upUntilSteps);
        
        
    }

    /**
     * @return int[]
     */
    public function getRegisters(): array
    {
        return $this->registers;
    }

    private function getCurrentInstruction(): ?Opcode
    {
        return $this->opcodes[$this->instructionPointer] ?? null;
    }

    public function step(): bool
    {
        $currentInstruction = $this->getCurrentInstruction();

        if ($currentInstruction === null) {
            return false;
        }

        $this->registers[$this->ipBoundTo] = $this->instructionPointer;
        $this->execute($currentInstruction);
        $this->instructionPointer = $this->registers[$this->ipBoundTo];
        ++$this->instructionPointer;

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
            new Opcode('addi', 3, 16, 3), // 0
            new Opcode('seti', 1, 8, 4), // 1
            new Opcode('seti', 1, 4, 5), // 2
            new Opcode('mulr', 4, 5, 1), // 3
            new Opcode('eqrr', 1, 2, 1), // 4
            new Opcode('addr', 1, 3, 3), // 5
            new Opcode('addi', 3, 1, 3), // 6
            new Opcode('addr', 4, 0, 0), // 7
            new Opcode('addi', 5, 1, 5), // 8
            new Opcode('gtrr', 5, 2, 1), // 9
            new Opcode('addr', 3, 1, 3), // 10
            new Opcode('seti', 2, 1, 3), // 11
            new Opcode('addi', 4, 1, 4), // 12
            new Opcode('gtrr', 4, 2, 1), // 13
            new Opcode('addr', 1, 3, 3), // 14
            new Opcode('seti', 1, 3, 3), // 15
            new Opcode('mulr', 3, 3, 3), // 16
            new Opcode('addi', 2, 2, 2), // 17
            new Opcode('mulr', 2, 2, 2), // 18
            new Opcode('mulr', 3, 2, 2), // 19
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
