<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2021\Day16;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day16Solution implements SolutionInterface, SecondPartSolutionInterface
{
    public function solve(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        $packet = (new PacketFactory())->create(self::createStream($input));

        return $this->getVersionSum($packet);
    }

    public function solveSecondPart(string $input = null)
    {
        $input ??= trim(file_get_contents(__DIR__ . '/input.txt'));

        return (new PacketFactory())
            ->create(self::createStream($input))
            ->getValue();
    }

    /**
     * @return resource
     */
    public static function createStream(string $input)
    {
        $stream = fopen('php://memory', 'r+');
        if (false === $stream) {
            throw new \RuntimeException();
        }

        fwrite($stream, $input);
        rewind($stream);

        return $stream;
    }

    private function getVersionSum(AbstractPacket $packet): int
    {
        $total = $packet->getVersion();
        if ($packet instanceof OperatorPacket) {
            foreach ($packet->getSubPackets() as $subPacket) {
                $total += $this->getVersionSum($subPacket);
            }
        }

        return $total;
    }
}
