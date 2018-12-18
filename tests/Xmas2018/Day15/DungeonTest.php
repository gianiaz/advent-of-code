<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day15;

use Jean85\AdventOfCode\Xmas2018\Day15\Dungeon;
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
}
