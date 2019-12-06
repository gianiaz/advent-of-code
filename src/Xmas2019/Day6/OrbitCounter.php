<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day6;

class OrbitCounter
{
    public function count(ObjectInSpace $centerOfMass): int
    {
        if ($centerOfMass->getOrbits()) {
            throw new \InvalidArgumentException('Input is not a COM!');
        }

        return $this->visit($centerOfMass, 0);
    }

    private function visit(ObjectInSpace $centerOfMass, int $startWith): int
    {
        $count = $startWith;

        foreach ($centerOfMass->getOrbitants() as $orbitant) {
            $count += $this->visit($orbitant, $startWith + 1);
        }

        return $count;
    }
}
