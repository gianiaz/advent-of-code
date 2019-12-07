<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day7;

use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Add;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Halt;
use Jean85\AdventOfCode\Xmas2019\Day2\Instructions\Multiply;
use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\Equals;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\JumpIfFalse;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\JumpIfTrue;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\LessThan;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\PushInOutput;
use Jean85\AdventOfCode\Xmas2019\Day5\Instructions\SaveFromInput;
use Jean85\AdventOfCode\Xmas2019\Day5\MemoryWithIO;

class Thruster
{
    /** @var int[] */
    private $program;

    /**
     * Thruster constructor.
     *
     * @param int[] $program
     */
    public function __construct(array $program)
    {
        $this->program = $program;
    }

    public function trySequence(array $initSequence): int
    {
        $output = 0;
        $computer = $this->creatComputer();

        for ($i = 0; $i < 5; ++$i) {
            $memory = $this->recreateMemory();
            $amplifier = new Amplifier($computer, $memory);

            $amplifier->execute($initSequence[$i]);
            $output = $amplifier->execute($output);
        }

        return $output;
    }

    private function creatComputer(): IntcodeComputer
    {
        return new IntcodeComputer([
            new Halt(),
            new Add(),
            new Multiply(),
            new PushInOutput(),
            new SaveFromInput(),
            new Equals(),
            new JumpIfFalse(),
            new JumpIfTrue(),
            new LessThan(),
        ]);
    }

    private function recreateMemory(): MemoryWithIO
    {
        return new MemoryWithIO($this->program);
    }
}
