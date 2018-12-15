<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day12;

use Jean85\AdventOfCode\Xmas2018\Day12\Tunnel;
use PHPUnit\Framework\TestCase;

class TunnelTest extends TestCase
{
    public function testGetNextGenerationOver20Iterations(): void
    {
        $tunnel = new Tunnel(str_split('#..#.#..##......###...###'), $this->getExampleRules());

        $generation = 0;
        $output = $this->printGeneration($tunnel, $generation) . PHP_EOL;

        while (++$generation <= 20) {
            $tunnel = $tunnel->getNextGeneration();
            $output .= $this->printGeneration($tunnel, $generation) . PHP_EOL;
        }

        $expectedResult = '0: ...#..#.#..##......###...###...........
1: ...#...#....#.....#..#..#..#...........
2: ...##..##...##....#..#..#..##..........
3: ..#.#...#..#.#....#..#..#...#..........
4: ...#.#..#...#.#...#..#..##..##.........
5: ....#...##...#.#..#..#...#...#.........
6: ....##.#.#....#...#..##..##..##........
7: ...#..###.#...##..#...#...#...#........
8: ...#....##.#.#.#..##..##..##..##.......
9: ...##..#..#####....#...#...#...#.......
10: ..#.#..#...#.##....##..##..##..##......
11: ...#...##...#.#...#.#...#...#...#......
12: ...##.#.#....#.#...#.#..##..##..##.....
13: ..#..###.#....#.#...#....#...#...#.....
14: ..#....##.#....#.#..##...##..##..##....
15: ..##..#..#.#....#....#..#.#...#...#....
16: .#.#..#...#.#...##...#...#.#..##..##...
17: ..#...##...#.#.#.#...##...#....#...#...
18: ..##.#.#....#####.#.#.#...##...##..##..
19: .#..###.#..#.#.#######.#.#.#..#.#...#..
20: .#....##....#####...#######....#.#..##.
';
        $this->assertSame($expectedResult, $output);
    }

    private function getExampleRules(): array
    {
        return [
            '...##' => '#',
            '..#..' => '#',
            '.#...' => '#',
            '.#.#.' => '#',
            '.#.##' => '#',
            '.##..' => '#',
            '.####' => '#',
            '#.#.#' => '#',
            '#.###' => '#',
            '##.#.' => '#',
            '##.##' => '#',
            '###..' => '#',
            '###.#' => '#',
            '####.' => '#',
        ];
    }

    private function printGeneration(Tunnel $tunnel, int $generation): string
    {
        $string = sprintf('%d: ', $generation);

        $pots = $tunnel->getPots();

        foreach (range(-3, 35) as $potNumber) {
            $string .= $pots[$potNumber] ?? '.';
        }

        return $string;
    }
}
