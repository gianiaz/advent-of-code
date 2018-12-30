<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day20;

use Jean85\AdventOfCode\Xmas2018\Day20\PathNode;
use PHPUnit\Framework\TestCase;

class PathNodeTest extends TestCase
{
    public function testGetPossiblePaths(): void
    {
        $rootNode = new PathNode('');
        $startingSteps = new PathNode('ABC');
        $rootNode->addBranch($startingSteps);
        $startingSteps->addBranch(new PathNode('1'));
        $startingSteps->addBranch(new PathNode('2'));

        $this->assertSame(['ABC1', 'ABC2'], iterator_to_array($rootNode->getPossiblePaths()));
    }
}
