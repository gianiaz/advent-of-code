<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\Dungeon;
use Jean85\AdventOfCode\Xmas2018\Day15\Elf;
use Jean85\AdventOfCode\Xmas2018\Day15\Goblin;
use PHPUnit\Framework\TestCase;

class DungeonTest extends TestCase
{
    /**
     * @dataProvider actualSituationDataProvider
     */
    public function testGetActualSituation(string $input, int $expectedElfCount, int $expectedGoblinCount): void
    {
        $dungeon = new Dungeon($input);

        $this->assertSame($input, $dungeon->getActualSituation());
        $this->assertCount($expectedElfCount, $dungeon->getElves());
        $this->assertCount($expectedGoblinCount, $dungeon->getGoblins());
    }

    public function actualSituationDataProvider(): array
    {
        return [
            ["###\n#.#\n###", 0, 0],
            ["###\n#E#\n###", 1, 0],
            ["###\n#G#\n###", 0, 1],
        ];
    }

    public function testGetActualSituationMapsWarriorsCorrectly(): void
    {
        $input = '#######
#.E...#
#..#..#
#..#G.#
#######';

        $dungeon = new Dungeon($input);

        $this->assertSame($input, $dungeon->getActualSituation());
        $this->assertCount(1, $dungeon->getElves());
        $this->assertCount(1, $dungeon->getGoblins());

        $elf = $dungeon->getElves()[0];
        $this->assertInstanceOf(Elf::class, $elf);
        $this->assertSame(2, $elf->getX());
        $this->assertSame(1, $elf->getY());

        $goblin = $dungeon->getGoblins()[0];
        $this->assertInstanceOf(Goblin::class, $goblin);
        $this->assertSame(4, $goblin->getX());
        $this->assertSame(3, $goblin->getY());
    }

    /**
     * @dataProvider tickDataProvider
     */
    public function testTick(string $initialSituation, string $expectedSituation): void
    {
        $dungeon = new Dungeon($initialSituation);

        $dungeon->tick();

        $this->assertSame($expectedSituation, $dungeon->getActualSituation());
    }

    public function tickDataProvider()
    {
        return [
            [
                '#######
#.E...#
#..#..#
#..#G.#
#######',
                '#######
#..E..#
#..#G.#
#..#..#
#######',
            ],
            [
                '#########
#...G...#
#.......#
#.......#
#G..E...#
#.......#
#.......#
#.......#
#########',
                '#########
#.......#
#...G...#
#...E...#
#.G.....#
#.......#
#.......#
#.......#
#########',
            ],
            [
                '#########
#.......#
#...G...#
#...E...#
#.G.....#
#.......#
#.......#
#.......#
#########',
                '#########
#.......#
#...G...#
#.G.E...#
#.......#
#.......#
#.......#
#.......#
#########',
            ],
            [
                '#########
#G..G..G#
#.......#
#.......#
#G..E..G#
#.......#
#.......#
#G..G..G#
#########',
                '#########
#.G...G.#
#...G...#
#...E..G#
#.G.....#
#.......#
#G..G..G#
#.......#
#########',
            ],
            [
                '#########
#.G...G.#
#...G...#
#...E..G#
#.G.....#
#.......#
#G..G..G#
#.......#
#########',
                '#########
#..G.G..#
#...G...#
#.G.E.G.#
#.......#
#G..G..G#
#.......#
#.......#
#########',
            ],
        ];
    }
}
