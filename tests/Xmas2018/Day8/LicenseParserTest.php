<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day8;

use Jean85\AdventOfCode\Xmas2018\Day8\LicenseNode;
use Jean85\AdventOfCode\Xmas2018\Day8\LicenseParser;
use PHPUnit\Framework\TestCase;

class LicenseParserTest extends TestCase
{
    /**
     * @dataProvider parseDataProvider
     */
    public function testParse(string $input, LicenseNode $rootNode): void
    {
        $parser = new LicenseParser();

        $this->assertEquals($rootNode, $parser->parse($input));
    }

    public function parseDataProvider()
    {
        yield ['0 3 1 1 2', $this->createNode(1, 1, 2)];

        $a = $this->createNode(1, 1, 2);
        $b = $this->createNode(10, 11, 12);
        $a->addChildNode($b);

        yield ['1 3 0 3 10 11 12 1 1 2', $a];

        $a = $this->createNode(1, 1, 2);
        $b = $this->createNode(10, 11, 12);
        $a->addChildNode($b);
        $c = $this->createNode(2);
        $d = $this->createNode(99);
        $c->addChildNode($d);
        $a->addChildNode($c);

        yield ['2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2', $a];
    }

    private function createNode(int ...$metadata): LicenseNode
    {
        $a = new LicenseNode();

        foreach ($metadata as $metadatum) {
            $a->addMetadata($metadatum);
        }

        return $a;
    }
}
