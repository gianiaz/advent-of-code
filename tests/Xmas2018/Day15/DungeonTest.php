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
        $turn = 0;

        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200, 200, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([200, 200], $dungeon->getElves());
        
        $turn++; // 1
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 197, 200, 197], $dungeon->getGoblins());
        $this->assertWarriorsHP([197, 197], $dungeon->getElves());
        
        $turn++; // 2
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200, 194, 194], $dungeon->getGoblins());
        $this->assertWarriorsHP([188, 194], $dungeon->getElves());
        
        do {
            $dungeon->tick();
        } while (++$turn < 23);
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 200, 131, 131], $dungeon->getGoblins());
        $this->assertWarriorsHP([131], $dungeon->getElves());

        $turn++;
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 200, 128], $dungeon->getGoblins());
        $this->assertWarriorsHP([128], $dungeon->getElves());

        $turn++;
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 125, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([125], $dungeon->getElves());

        $turn++;
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 122, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([122], $dungeon->getElves());

        $turn++;
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 119, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([119], $dungeon->getElves());

        $turn++;
        $dungeon->tick();
        
        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 116, 200], $dungeon->getGoblins());
        $this->assertWarriorsHP([113], $dungeon->getElves());

        do {
            $dungeon->tick();
        } while (++$turn < 47);

        $this->assertSame($outcomes[$turn], $dungeon->getActualSituation());
        $this->assertWarriorsHP([200, 131, 59, 131], $dungeon->getGoblins());
        $this->assertEmpty($dungeon->getElves());
    }

    public function testGetActualSituationWithFullCombat(): void
    {
        $outcomes = $this->getFullCombatSequence();
        
        $dungeon = new Dungeon($outcomes[0]);

        $this->assertSame($outcomes[0], $dungeon->getActualSituation());
        $turns = 0;

        foreach ($outcomes as $turn => $situation) {
            while ($turns < $turn) {
                $turns++;
                $dungeon->tick();
            }
            
            $this->assertSame($situation, $dungeon->getActualSituation(), 'Failed on turn ' . $turn . ' ' . $turns);
        }

        $this->assertSame($situation, $dungeon->getActualSituation(), 'Something happened, game should have ended!');

        $this->assertSame(47, $turns);
        $this->assertSame(590, $dungeon->getTotalHealth());
        $this->assertSame(27730, $dungeon->getTotalHealth() * $turns);
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
                1=> '#######
#..G..#
#...EG#
#.#G#G#
#...#E#
#.....#
#######',
                2=> '#######
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
    public function testGetOutcome(string $input, string $expectedSituation, int $expectedOutcome, int $expectedTurn, int $expectedTotalHP): void
    {
        $this->assertSame($expectedOutcome, $expectedTotalHP * $expectedTurn, 'BAD PROVIDER');

        $dungeon = new Dungeon($input);

        $turns = 0;
        while ($dungeon->tick()) {
            ++$turns;
        }

        $this->assertSame($expectedSituation, $dungeon->getActualSituation());
        $this->assertSame($expectedTurn, $turns);
        $this->assertSame($expectedTotalHP, $dungeon->getTotalHealth());
        $this->assertSame($expectedOutcome, $dungeon->getTotalHealth() * $turns);
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
                18740, 20, 937,
            ],
        ];
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
