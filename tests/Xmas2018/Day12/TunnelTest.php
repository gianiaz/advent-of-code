<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day12;

use Jean85\AdventOfCode\Xmas2018\Day12\Tunnel;
use PHPUnit\Framework\TestCase;

class TunnelTest extends TestCase
{
    public function testGetNextGeneration(): void
    {
        $tunnel = new Tunnel('##..##...##....#..#..#..##..........', $this->getExampleRules());

        $tunnel->evolve();

        $this->assertSame('...#.#...#..#.#....#..#..#...#..', $tunnel->getPots());
    }

    public function testGetNextGenerationOver20Iterations(): void
    {
        $tunnel = new Tunnel($this->getExampleInitialState(), $this->getExampleRules());

        $generation = 0;
        $output[] = $this->printGeneration($tunnel, $generation);

        while (++$generation <= 20) {
            $tunnel->evolve();
            $output[] = $this->printGeneration($tunnel, $generation);
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
20: .#....##....#####...#######....#.#..##.';
        $this->assertSame($expectedResult, implode(PHP_EOL, $output));
    }

    public function testGetSum(): void
    {
        $tunnel = new Tunnel($this->getExampleInitialState(), $this->getExampleRules());

        $generation = 0;
        while (++$generation <= 20) {
            $tunnel->evolve();
        }

        $this->assertSame(325, $tunnel->getSum());
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
        $pots = $tunnel->getPots();
        $shiftToTheLeft = $tunnel->getFirstPotNumber() + 3;

        if ($shiftToTheLeft > 0) {
            $pots = str_repeat('.', $shiftToTheLeft) . $pots;
        } elseif ($shiftToTheLeft < 0) {
            $pots = \substr($pots, -$shiftToTheLeft);
        }

        return sprintf('%d: %s', $generation, str_pad($pots, 39, '.'));
    }

    private function getExampleInitialState(): string
    {
        return '#..#.#..##......###...###';
    }
}
