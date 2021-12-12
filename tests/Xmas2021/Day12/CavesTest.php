<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day12;

use Jean85\AdventOfCode\Xmas2021\Day12\Caves;
use PHPUnit\Framework\TestCase;

class CavesTest extends TestCase
{
    /**
     * @dataProvider pathsDataProvider
     */
    public function testGetAllPaths(string $input, string $expectedPaths): void
    {
        $caves = new Caves($input);

        $allPaths = $caves->getAllPaths();
        foreach ($allPaths as &$path) {
            $path = implode(',', $path);
        }
        sort($allPaths);

        $this->assertSame($expectedPaths, implode(PHP_EOL, $allPaths));
    }

    public function pathsDataProvider(): array
    {
        return [
            [
                'start-A
start-b
A-c
A-b
b-d
A-end
b-end',
                'start,A,b,A,c,A,end
start,A,b,A,end
start,A,b,end
start,A,c,A,b,A,end
start,A,c,A,b,end
start,A,c,A,end
start,A,end
start,b,A,c,A,end
start,b,A,end
start,b,end',
            ],
            [
                'dc-end
HN-start
start-kj
dc-start
dc-HN
LN-dc
HN-end
kj-sa
kj-HN
kj-dc',
                'start,HN,dc,HN,end
start,HN,dc,HN,kj,HN,end
start,HN,dc,end
start,HN,dc,kj,HN,end
start,HN,end
start,HN,kj,HN,dc,HN,end
start,HN,kj,HN,dc,end
start,HN,kj,HN,end
start,HN,kj,dc,HN,end
start,HN,kj,dc,end
start,dc,HN,end
start,dc,HN,kj,HN,end
start,dc,end
start,dc,kj,HN,end
start,kj,HN,dc,HN,end
start,kj,HN,dc,end
start,kj,HN,end
start,kj,dc,HN,end
start,kj,dc,end',
            ],
        ];
    }
}
