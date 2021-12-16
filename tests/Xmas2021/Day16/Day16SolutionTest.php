<?php

declare(strict_types=1);

namespace Tests\Xmas2021\Day16;

use Jean85\AdventOfCode\Xmas2021\Day16\Day16Solution;
use PHPUnit\Framework\TestCase;

class Day16SolutionTest extends TestCase
{
    /**
     * @dataProvider packetsWithVersionSumDataProvider
     */
    public function test(string $input, int $expectedVersionSum): void
    {
        $day16Solution = new Day16Solution();

        $this->assertSame($expectedVersionSum, $day16Solution->solve($input));
    }

    /**
     * @return array{string, int}[]
     */
    public function packetsWithVersionSumDataProvider(): array
    {
        return [
            ['8A004A801A8002F478', 16],
            ['620080001611562C8802118E34', 12],
            ['C0015000016115A2E0802F182340', 23],
            ['A0016C880162017C3686B18A3D4780', 31],
        ];
    }

    /**
     * @dataProvider proxyDataProvider
     * @dataProvider secondPartDataProvider
     */
    public function testSecondPart(string $input, int $expectedValue): void
    {
        $day16Solution = new Day16Solution();

        $this->assertSame($expectedValue, $day16Solution->solveSecondPart($input));
    }

    public function secondPartDataProvider(): array
    {
        return [
            ['8A004A801A8002F478', 15],
            ['620080001611562C8802118E34', 46],
            ['C0015000016115A2E0802F182340', 46],
            ['A0016C880162017C3686B18A3D4780', 54],
        ];
    }

    public function proxyDataProvider(): array
    {
        return (new OperatorPacketTest())->valueDataProvider();
    }
}
