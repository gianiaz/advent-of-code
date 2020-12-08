<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day8;

use Jean85\AdventOfCode\Xmas2020\Day8\GameConsole;
use Jean85\AdventOfCode\Xmas2020\Day8\ProgramParser;
use PHPUnit\Framework\TestCase;

class GameConsoleTest extends TestCase
{
    public function testRun(): void
    {
        $input = 'nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6';

        $program = ProgramParser::parse($input);
        $gameConsole = new GameConsole($program);

        $gameConsole->run();

        $this->assertSame(5, $gameConsole->getAccumulator());
    }

    public function testRunToTermination(): void
    {
        $input = 'nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
nop -4
acc +6';

        $program = ProgramParser::parse($input);
        $gameConsole = new GameConsole($program);

        $this->assertTrue($gameConsole->runToTermination($program));

        $this->assertSame(8, $gameConsole->getAccumulator());
    }

    public function testRunToTerminationFails(): void
    {
        $input = 'nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6';

        $program = ProgramParser::parse($input);
        $gameConsole = new GameConsole($program);

        $this->assertFalse($gameConsole->runToTermination($program));
    }
}
