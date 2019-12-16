<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day12;

use Jean85\AdventOfCode\Xmas2019\Day12\Day12Solution;
use Jean85\AdventOfCode\Xmas2019\Day12\JupiterSimulator;
use Jean85\AdventOfCode\Xmas2019\Day12\Moon;
use PHPUnit\Framework\TestCase;

class JupiterSimulatorTest extends TestCase
{
    /**
     * @dataProvider situationDataProvider
     */
    public function testGetSituation(int $iterations, string $expected): void
    {
        $simulator = $this->createSimulator1();

        while ($iterations--) {
            $simulator->tick();
        }

        $this->assertSame($expected, $simulator->getSituation());
    }

    public function situationDataProvider(): array
    {
        return [
            [
                0,
                'pos=<x=-1, y=0, z=2>, vel=<x=0, y=0, z=0>
pos=<x=2, y=-10, z=-7>, vel=<x=0, y=0, z=0>
pos=<x=4, y=-8, z=8>, vel=<x=0, y=0, z=0>
pos=<x=3, y=5, z=-1>, vel=<x=0, y=0, z=0>',
            ],
            [
                1,
                'pos=<x=2, y=-1, z=1>, vel=<x=3, y=-1, z=-1>
pos=<x=3, y=-7, z=-4>, vel=<x=1, y=3, z=3>
pos=<x=1, y=-7, z=5>, vel=<x=-3, y=1, z=-3>
pos=<x=2, y=2, z=0>, vel=<x=-1, y=-3, z=1>',
            ],
            [
                2,
                'pos=<x=5, y=-3, z=-1>, vel=<x=3, y=-2, z=-2>
pos=<x=1, y=-2, z=2>, vel=<x=-2, y=5, z=6>
pos=<x=1, y=-4, z=-1>, vel=<x=0, y=3, z=-6>
pos=<x=1, y=-4, z=2>, vel=<x=-1, y=-6, z=2>',
            ],
            [
                3,
                'pos=<x=5, y=-6, z=-1>, vel=<x=0, y=-3, z=0>
pos=<x=0, y=0, z=6>, vel=<x=-1, y=2, z=4>
pos=<x=2, y=1, z=-5>, vel=<x=1, y=5, z=-4>
pos=<x=1, y=-8, z=2>, vel=<x=0, y=-4, z=0>',
            ],
            [
                4,
                'pos=<x=2, y=-8, z=0>, vel=<x=-3, y=-2, z=1>
pos=<x=2, y=1, z=7>, vel=<x=2, y=1, z=1>
pos=<x=2, y=3, z=-6>, vel=<x=0, y=2, z=-1>
pos=<x=2, y=-9, z=1>, vel=<x=1, y=-1, z=-1>',
            ],
            [
                5,
                'pos=<x=-1, y=-9, z=2>, vel=<x=-3, y=-1, z=2>
pos=<x=4, y=1, z=5>, vel=<x=2, y=0, z=-2>
pos=<x=2, y=2, z=-4>, vel=<x=0, y=-1, z=2>
pos=<x=3, y=-7, z=-1>, vel=<x=1, y=2, z=-2>',
            ],
            [
                6,
                'pos=<x=-1, y=-7, z=3>, vel=<x=0, y=2, z=1>
pos=<x=3, y=0, z=0>, vel=<x=-1, y=-1, z=-5>
pos=<x=3, y=-2, z=1>, vel=<x=1, y=-4, z=5>
pos=<x=3, y=-4, z=-2>, vel=<x=0, y=3, z=-1>',
            ],
            [
                7,
                'pos=<x=2, y=-2, z=1>, vel=<x=3, y=5, z=-2>
pos=<x=1, y=-4, z=-4>, vel=<x=-2, y=-4, z=-4>
pos=<x=3, y=-7, z=5>, vel=<x=0, y=-5, z=4>
pos=<x=2, y=0, z=0>, vel=<x=-1, y=4, z=2>',
            ],
            [
                8,
                'pos=<x=5, y=2, z=-2>, vel=<x=3, y=4, z=-3>
pos=<x=2, y=-7, z=-5>, vel=<x=1, y=-3, z=-1>
pos=<x=0, y=-9, z=6>, vel=<x=-3, y=-2, z=1>
pos=<x=1, y=1, z=3>, vel=<x=-1, y=1, z=3>',
            ],
            [
                9,
                'pos=<x=5, y=3, z=-4>, vel=<x=0, y=1, z=-2>
pos=<x=2, y=-9, z=-3>, vel=<x=0, y=-2, z=2>
pos=<x=0, y=-8, z=4>, vel=<x=0, y=1, z=-2>
pos=<x=1, y=1, z=5>, vel=<x=0, y=0, z=2>',
            ],
            [
                10,
                'pos=<x=2, y=1, z=-3>, vel=<x=-3, y=-2, z=1>
pos=<x=1, y=-8, z=0>, vel=<x=-1, y=1, z=3>
pos=<x=3, y=-6, z=1>, vel=<x=3, y=2, z=-3>
pos=<x=2, y=0, z=4>, vel=<x=1, y=-1, z=-1>',
            ],
        ];
    }

    public function testGetTotalEnergy(): void
    {
        $simulator = $this->createSimulator2();

        $iterations = 100;
        while ($iterations--) {
            $simulator->tick();
        }

        $expectedSituation = 'pos=<x=8, y=-12, z=-9>, vel=<x=-7, y=3, z=0>
pos=<x=13, y=16, z=-3>, vel=<x=3, y=-11, z=-5>
pos=<x=-29, y=-11, z=-1>, vel=<x=-3, y=7, z=4>
pos=<x=16, y=-13, z=23>, vel=<x=7, y=1, z=1>';
        $this->assertSame($expectedSituation, $simulator->getSituation());
        $this->assertSame(1940, $simulator->getTotalEnergy());
    }

    /**
     * @dataProvider repetitionDataProvider
     */
    public function testFindRepetitions(JupiterSimulator $simulator, int $expected): void
    {
        $solution = new Day12Solution();

        $this->assertSame($expected, $solution->solveSecondPart($simulator));
    }

    public function repetitionDataProvider(): array
    {
        return [
            [$this->createSimulator1(), 2772],
            [$this->createSimulator2(), 4686774924],
        ];
    }

    private function createSimulator1(): JupiterSimulator
    {
        return new JupiterSimulator(
            new Moon(-1, 0, 2),
            new Moon(2, -10, -7),
            new Moon(4, -8, 8),
            new Moon(3, 5, -1)
        );
    }

    private function createSimulator2(): JupiterSimulator
    {
        return new JupiterSimulator(
            new Moon(-8, -10, 0),
            new Moon(5, 5, 10),
            new Moon(2, -7, 3),
            new Moon(9, -8, -3)
        );
    }
}
