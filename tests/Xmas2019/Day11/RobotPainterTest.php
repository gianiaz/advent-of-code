<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day11;

use Jean85\AdventOfCode\Xmas2019\Day11\EmergencyHull;
use Jean85\AdventOfCode\Xmas2019\Day11\RobotPainter;
use Jean85\AdventOfCode\Xmas2019\Day2\IntcodeComputer;
use Jean85\AdventOfCode\Xmas2019\Day7\MemoryWithSequentialIO;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class RobotPainterTest extends TestCase
{
    public function testWithMockBrain(): void
    {
        $hull = new EmergencyHull();
        $computer = $this->prophesize(IntcodeComputer::class);
        $memory = $this->prophesize(MemoryWithSequentialIO::class);
        $robot = new RobotPainter($computer->reveal(), $hull);

        $computer->run($memory->reveal())
            ->shouldBeCalled()
            ->willReturn(true, true, true, true, true, true, true, false);

        $memory->setInput(Argument::cetera())
            ->shouldBeCalled();
        $memory->getOutput()
            ->willReturn(
                1,
                0,
                0,
                0,
                1,
                0,
                1,
                0,
                0,
                1,
                1,
                0,
                1,
                0
            );

        $robot->paint($memory->reveal());

        $this->assertSame(6, $hull->getPaintedCount());
    }
}
