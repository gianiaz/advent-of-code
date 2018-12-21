<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\AlteredDungeon;
use Jean85\AdventOfCode\Xmas2018\Day15\Elf;
use Jean85\AdventOfCode\Xmas2018\Day15\ElfDied;
use PHPUnit\Framework\TestCase;

class AlteredDungeonTest extends TestCase
{
    /**
     * @dataProvider alteredDungeonDataProvider
     */
    public function testSomeElfWillDie(int $minimumAttackToSurvive, string $init): void
    {
        $dungeon = new AlteredDungeon($init, $minimumAttackToSurvive - 1);

        $this->expectException(ElfDied::class);

        do {
        } while ($dungeon->tick());

        $this->fail('No elf died! Reached turn ' . $dungeon->getTurns() . PHP_EOL . $dungeon->getActualSituation());
    }

    /**
     * @dataProvider alteredDungeonDataProvider
     */
    public function testNoElfWillDie(int $minimumAttackToSurvive, string $init, string $expectedSituation, int $reachedTurn, array $expectedHPs): void
    {
        $dungeon = new AlteredDungeon($init, $minimumAttackToSurvive);

        do {
        } while ($dungeon->tick());

        $this->assertSame($expectedSituation, $dungeon->getActualSituation());
        $this->assertSame($reachedTurn, $dungeon->getTurns());
        $this->assertElvesHP($expectedHPs, $dungeon);
        $this->assertSame(\array_sum($expectedHPs) * $reachedTurn, $dungeon->getOutcome());
    }

    public function alteredDungeonDataProvider(): array
    {
        return [
            [
                15,
                '#######
#.G...#
#...EG#
#.#.#G#
#..G#E#
#.....#
#######',
                '#######
#..E..#
#...E.#
#.#.#.#
#...#.#
#.....#
#######',
                29,
                [158, 14],
            ],
        ];
    }

    /**
     * @param int[] $expectedHPs
     */
    private function assertElvesHP(array $expectedHPs, AlteredDungeon $dungeon): void
    {
        $this->assertEmpty($dungeon->getGoblins(), 'There are goblins still alive!');
        $elves = $dungeon->getElves();
        \usort($elves, function (Elf $a, Elf $b) {
            return $a->compareByReadingOrder($b);
        });

        foreach ($expectedHPs as $key => $expectedHP) {
            $warrior = $elves[$key];
            $this->assertSame(
                $expectedHP,
                $warrior->getHealth(),
                sprintf('Wrong HP on %s at %d,%d', $warrior, $warrior->getX(), $warrior->getY())
            );
        }
    }
}
