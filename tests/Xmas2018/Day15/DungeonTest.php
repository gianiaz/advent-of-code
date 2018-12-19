<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\AbstractWarrior;
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

    public function tickDataProvider(): array
    {
        return [
            'simple with obstacle' => [
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
            'only 2 goblins' => [
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
            'only 2 goblins, step 2' => [
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
            'example from the site' => [
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
            'last step from example' => [
                '#########
#..G.G..#
#...G...#
#.G.E.G.#
#.......#
#G..G..G#
#.......#
#.......#
#########',
                '#########
#.......#
#..GGG..#
#..GEG..#
#G..G...#
#......G#
#.......#
#.......#
#########',
            ],
        ];
    }

    public function testGetActualSituationWithLimitedCombat(): void
    {
        $outcomes = $this->getFullCombatSequence();
        $dungeon = new Dungeon($outcomes[0]);

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200, 200, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 197, 200, 197], $dungeon->getGoblins());
        $this->assertWarriorsHP([197, 197], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200, 194, 194], $dungeon->getGoblins());
        $this->assertWarriorsHP([188, 194], $dungeon->getElves());

        do {
            $dungeon->tick();
        } while ($dungeon->getTurns() < 23);

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200, 131, 131], $dungeon->getGoblins());
        $this->assertWarriorsHP([131], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 200, 128], $dungeon->getGoblins());
        $this->assertWarriorsHP([128], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 125, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([125], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 122, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([122], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 119, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([119], $dungeon->getElves());

        $dungeon->tick();

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 116, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([113], $dungeon->getElves());

        do {
            $dungeon->tick();
        } while ($dungeon->getTurns() < 47);

        $this->assertSame($outcomes[$dungeon->getTurns()], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 59, 200], $dungeon->getGoblins());
        $this->assertEmpty($dungeon->getElves());
    }

    public function testGetActualSituationWithFullCombat(): void
    {
        $outcomes = $this->getFullCombatSequence();

        $dungeon = new Dungeon($outcomes[0]);

        $this->assertSame($outcomes[0], $dungeon->getActualSituation());

        foreach ($outcomes as $turn => $situation) {
            while ($dungeon->getTurns() < $turn) {
                $dungeon->tick();
            }

            $this->assertSame($situation, $dungeon->getActualSituation(), 'Failed on turn ' . $turn);
        }

        $this->assertSame($situation, $dungeon->getActualSituation(), 'Something happened, game should have ended!');

        $this->assertSame(47, $dungeon->getTurns());
        $this->assertSame(590, $dungeon->getTotalHealth());
        $this->assertSame(27730, $dungeon->getOutcome());
    }

    public function getFullCombatSequence(): array
    {
        return [
            0 => '#######
#.G...#
#...EG#
#.#.#G#
#..G#E#
#.....#
#######',
            1 => '#######
#..G..#
#...EG#
#.#G#G#
#...#E#
#.....#
#######',
            2 => '#######
#...G.#
#..GEG#
#.#.#G#
#...#E#
#.....#
#######',
            23 => '#######
#...G.#
#..G.G#
#.#.#G#
#...#E#
#.....#
#######',
            24 => '#######
#..G..#
#...G.#
#.#G#G#
#...#E#
#.....#
#######',
            25 => '#######
#.G...#
#..G..#
#.#.#G#
#..G#E#
#.....#
#######',
            26 => '#######
#G....#
#.G...#
#.#.#G#
#...#E#
#..G..#
#######',
            27 => '#######
#G....#
#.G...#
#.#.#G#
#...#E#
#...G.#
#######',
            28 => '#######
#G....#
#.G...#
#.#.#G#
#...#E#
#....G#
#######',
            47 => '#######
#G....#
#.G...#
#.#.#G#
#...#.#
#....G#
#######',
        ];
    }

    /**
     * @dataProvider getOutcomeProvider
     */
    public function testGetOutcome(string $input, string $expectedSituation, array $expectedElvesHP, array $expectedGoblinsHP, int $expectedOutcome, int $expectedTurn, int $expectedTotalHP): void
    {
        $this->assertSame($expectedOutcome, $expectedTotalHP * $expectedTurn, 'BAD PROVIDER');

        $dungeon = new Dungeon($input);

        do {
        } while ($dungeon->tick());

        $this->assertSame($expectedSituation, $dungeon->getActualSituation());
        $this->assertWarriorsHP($expectedElvesHP, $dungeon->getElves());
        $this->assertWarriorsHP($expectedGoblinsHP, $dungeon->getGoblins());
        $this->assertSame($expectedTotalHP, $dungeon->getTotalHealth());
        $this->assertSame($expectedTurn, $dungeon->getTurns());
        $this->assertSame($expectedOutcome, $dungeon->getTotalHealth() * $dungeon->getTurns());
    }

    public function getOutcomeProvider(): array
    {
        return[
            [
                '#######   
#.G...#
#...EG#
#.#.#G#
#..G#E#
#.....#
#######',
                '#######   
#G....#
#.G...#
#.#.#G#
#...#.#
#....G#
#######',
                [], [200, 131, 59, 200],
                27730, 47, 590,
            ],
            [
                '#######
#G..#E#
#E#E.E#
#G.##.#
#...#E#
#...E.#
#######',
                '#######
#...#E#
#E#...#
#.E##.#
#E..#E#
#.....#
#######',
                [200, 197, 185, 200, 200], [],
                36334, 37, 982,
            ],
            [
                '#######
#E..EG#
#.#G.E#
#E.##E#
#G..#.#
#..E#.#
#######',
                '#######
#.E.E.#
#.#E..#
#E.##.#
#.E.#.#
#...#.#
#######',
                [164, 197, 200, 98, 200], [],
                39514, 46, 859,
            ],
            [
                '#######
#E.G#.#
#.#G..#
#G.#.G#
#G..#.#
#...E.#
#######',
                '#######
#G.G#.#
#.#G..#
#..#..#
#...#G#
#...G.#
#######',
                [], [200, 98, 200, 95, 200],
                27755, 35, 793,
            ],
            [
                '#######
#.E...#
#.#..G#
#.###.#
#E#G#G#
#...#G#
#######',
                '#######
#.....#
#.#G..#
#.###.#
#.#.#.#
#G.G#G#
#######',
                [], [200, 98, 38, 200],
                28944, 54, 536,
            ],
            [
                '#########
#G......#
#.E.#...#
#..##..G#
#...##..#
#...#...#
#.G...G.#
#.....G.#
#########',
                '#########
#.G.....#
#G.G#...#
#.G##...#
#...##..#
#.G.#...#
#.......#
#.......#
#########',
                [], [137, 200, 200, 200, 200],
                18740, 20, 937,
            ],
        ];
    }

    public function testGetOutcomeDebugCornerCase(): void
    {
        $input = '#######
#G..#E#
#E#E.E#
#G.##.#
#...#E#
#...E.#
#######';
        $dungeon = new Dungeon($input);

        $this->assertSame($input, $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 200, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#G.E#E#
#E#..E#
#G.##.#
#...#E#
#..E..#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([197, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 194, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#..E#
#G.##.#
#..E#E#
#.....#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([191, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 188, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#..E#
#G.##.#
#.E.#.#
#....E#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([185, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 182, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#..E#
#GE##.#
#...#.#
#...E.#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([179, 197], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 176, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#..E#
#GE##.#
#...#.#
#..E..#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([173, 194], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 170, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#..E#
#GE##.#
#..E#.#
#.....#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([167, 191], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 164, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#...#
#GE##E#
#.E.#.#
#.....#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([161, 188], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 158, 200, 200, 200], $dungeon->getElves());

        $dungeon->tick();

        $situation = '#######
#GE.#E#
#E#...#
#GE##.#
#E..#E#
#.....#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([155, 182], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 152, 200, 200, 200], $dungeon->getElves());
        
        do {
            $dungeon->tick();
            $this->assertSame($situation, $dungeon->getActualSituation(), 'At turn ' . $dungeon->getTurns());
        } while($dungeon->getTurns() < 33);

        $this->assertWarriorsHP([5, 32], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 2, 200, 200, 200], $dungeon->getElves());


        $dungeon->tick();

        $situation = '#######
#GE.#E#
#.#...#
#GE##.#
#E..#E#
#.....#
#######';

        $this->assertSame($situation, $dungeon->getActualSituation());
        $this->assertWarriorsHP([2, 26], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200, 197, 200, 200], $dungeon->getElves());
    }

    /**
     * @param int[] $expectedHPs
     * @param AbstractWarrior[] $warriors
     */
    private function assertWarriorsHP(array $expectedHPs, array $warriors): void
    {
        \usort($warriors, function (AbstractWarrior $a, AbstractWarrior $b) {
            return $a->compareByDistanceOnly($b);
        });

        foreach ($expectedHPs as $key => $expectedHP) {
            $warrior = $warriors[$key];
            $this->assertSame(
                $expectedHP,
                $warrior->getHealth(),
                sprintf('Wrong HP on %s at %d,%d', $warrior, $warrior->getX(), $warrior->getY())
            );
        }
    }
}
