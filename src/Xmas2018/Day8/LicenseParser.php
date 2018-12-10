<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day8;

class LicenseParser
{
    public function parse(string $input): LicenseNode
    {
        $values = explode(' ', $input);

        return $this->extractNode($values);
    }

    /**
     * @param string[] $values
     */
    private function extractNode(array &$values): LicenseNode
    {
        $node = new LicenseNode();
        $childNodes = (int) array_shift($values);
        $metadataCount = (int) array_shift($values);

        while ($childNodes--) {
            $node->addChildNode($this->extractNode($values));
        }

        while ($metadataCount--) {
            $node->addMetadata((int) array_shift($values));
        }

        return $node;
    }
}
