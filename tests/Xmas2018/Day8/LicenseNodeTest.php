<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day8;

use Jean85\AdventOfCode\Xmas2018\Day8\LicenseNode;
use PHPUnit\Framework\TestCase;

class LicenseNodeTest extends TestCase
{
    public function testGetValueWithoutChilds(): void
    {
        $node = new LicenseNode();
        $node->addMetadata(10);
        $node->addMetadata(11);
        $node->addMetadata(12);

        $this->assertSame(33, $node->getValue());
    }

    public function testGetValueInTestInput(): void
    {
        $a = $this->createNode(1, 1, 2);
        $b = $this->createNode(10, 11, 12);
        $a->addChildNode($b);
        $c = $this->createNode(2);
        $d = $this->createNode(99);
        $c->addChildNode($d);
        $a->addChildNode($c);

        $this->assertSame(66, $a->getValue());
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
