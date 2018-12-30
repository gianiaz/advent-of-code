<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day20;

use Jean85\AdventOfCode\Xmas2018\Day20\Construction;
use PHPUnit\Framework\TestCase;

class ConstructionTest extends TestCase
{
    /**
     * @dataProvider processPathsProvider
     */
    public function testProcessPaths(array $instructions, array $possiblePaths, string $expectedMap): void
    {
        $construction = new Construction($instructions);

        $construction->processPaths();

        $this->assertArraySubset($possiblePaths, $construction->getPossiblePaths());
        $this->assertSame($expectedMap, \trim($construction->getTextualMap()), $construction->getTextualMap());
    }

    public function processPathsProvider(): array
    {
        return [
            [
                ['WNE'],
                ['WNE'],
                '#####
#.|.#
#-###
#.|X#
#####',
            ],
        ];
    }
}
