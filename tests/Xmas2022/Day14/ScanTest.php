<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day14;

use Jean85\AdventOfCode\Xmas2022\Day14\Scan;
use PHPUnit\Framework\TestCase;

class ScanTest extends TestCase
{
    public function test(): void
    {
        $scan = new Scan(Day14SolutionTest::TEST_INPUT);

        $this->assertSame('    #   ##
    #   # 
  ###   # 
        # 
        # 
######### 
', $scan->printMap());

        $sandCount = $scan->dropSand();

        $this->assertSame(24, $sandCount);
    }
}
