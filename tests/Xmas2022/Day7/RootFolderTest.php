<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day7;

use Jean85\AdventOfCode\Xmas2022\Day7\RootFolder;
use PHPUnit\Framework\TestCase;

class RootFolderTest extends TestCase
{
    public function testRootFolderConstructionFromInput(): void
    {
        $rootFolder = RootFolder::createFromInput(Day7SolutionTest::TEST_INPUT);

        $this->assertSame(48381165, $rootFolder->getSize());
        $a = $rootFolder->getSubFolder('a');
        $e = $a->getSubFolder('e');
        $this->assertSame(584, $e->getSize());
        $this->assertSame(94853, $a->getSize());
        $d = $rootFolder->getSubFolder('d');
        $this->assertSame(24933642, $d->getSize());
    }
}
