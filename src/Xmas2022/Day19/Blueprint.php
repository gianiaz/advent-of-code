<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day19;

class Blueprint
{
    private int $minutes = 0;
    /** @var array<string, Robot> */
    private array $robots = [];
    /** @var array<string, int> */
    private array $inProgressBuilds = [];

    public function __construct(string $input)
    {
        $input = trim($input, '. ');

        foreach (explode('.', $input) as $instruction) {
            $pattern = '/Each (\w+) robot costs (\d+) (\w+)( and (\d+) (\w+))?/';
            if (1 !== \Safe\preg_match($pattern, $instruction, $matches)) {
                throw new \InvalidArgumentException('Unable to parse blueprint: ' . $instruction);
            }

            $harvestedMaterial = Material::from($matches[1]);
            $recipe = [new RequiredMaterial(Material::from($matches[3]), (int) $matches[2])];
            if ($matches[4] ?? false) {
                $recipe[] = new RequiredMaterial(Material::from($matches[6]), (int) $matches[5]);
            }

            $this->robots[$harvestedMaterial->value] = new Robot($harvestedMaterial, ...$recipe);
            $this->inProgressBuilds[$harvestedMaterial->value] = 0;
        }

        $this->robots[Material::Ore->value]->addRobot();
    }

    public function tick(): string
    {
        $output = sprintf('== Minute %d ==', ++$this->minutes);
        $output .= PHP_EOL;

        foreach (array_reverse($this->robots) as $robot) {
            $output .= $this->tryToBuild($robot);
        }

        foreach ($this->robots as $robot) {
            if ($robot->getRobotCount() > 0) {
                $output .= $this->collectMaterial($robot);
            }
        }

        foreach ($this->inProgressBuilds as $material => $inProgressCount) {
            if ($inProgressCount > 0) {
                $this->inProgressBuilds[$material] = 0;

                $output .= 'The new ' . $material . '-collecting robot is ready;';

                do {
                    $this->robots[$material]->addRobot();
                } while (--$inProgressCount);

                $output .= sprintf(' you now have %d of them.', $this->robots[$material]->getRobotCount()) . PHP_EOL;
            }
        }

        return trim($output);
    }

    private function tryToBuild(Robot $robot): string
    {
        foreach ($robot->recipe as $needed) {
            $collectedMaterial = $this->robots[$needed->material->value]->collectedMaterial;
            if ($collectedMaterial < $needed->qty) {
                return '';
            }

            foreach ($this->robots as $otherRobot) {
                foreach ($otherRobot->recipe as $contendedMaterial) {
                    if (
                        $contendedMaterial->material === $needed->material
                        && ($otherRobot->getRobotCount() + 2 < $robot->getRobotCount())
                    ) {
                        // try not to be greedy if material is contended
                        return '';
                    }
                }
            }
        }

        $output = 'Spend ';
        foreach ($robot->recipe as $i => $needed) {
            if ($i > 0) {
                $output .= ' and ';
            }

            $this->robots[$needed->material->value]->collectedMaterial -= $needed->qty;
            $output .= $needed->qty . ' ' . $needed->material->value;
        }

        $this->inProgressBuilds[$robot->material->value] += 1;
        $output .= sprintf(
            ' to start building a%s %s-collecting robot.',
            $robot->material === Material::Obsidian ? 'n' : '',
            $robot->material->value
        );

        return $output . PHP_EOL;
    }

    private function collectMaterial(Robot $robot): string
    {
        $robot->collectedMaterial += $robot->getRobotCount();

        return sprintf(
            '%d %s-collecting robot%s collect%s %d %s; you now have %d %s.',
            $robot->getRobotCount(),
            $robot->material->value,
            $robot->getRobotCount() > 1 ? 's' : '',
            $robot->getRobotCount() > 1 ? '' : 's',
            $robot->getRobotCount(),
            $robot->material->value,
            $robot->collectedMaterial,
            $robot->material->value,
        ) . PHP_EOL;
    }
}
